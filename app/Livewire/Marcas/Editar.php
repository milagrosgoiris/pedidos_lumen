<?php

namespace App\Livewire\Marcas;

use App\Models\Marca;
use App\Models\Proveedor;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.app')]
#[Title('Editar marca')]
class Editar extends Component
{
    public Marca $marca;

    public ?int $proveedor_id = null;
    public string $nombre = '';

    public function mount(Marca $marca): void
    {
        $this->marca        = $marca;
        $this->proveedor_id = $marca->proveedor_id;
        $this->nombre       = $marca->nombre;
    }

    public function update()
    {
        $this->validate([
            'proveedor_id' => ['required', 'exists:proveedores,id'],
            'nombre' => [
                'required', 'string', 'max:120',
                Rule::unique('marcas', 'nombre')
                    ->where(fn($q) => $q->where('proveedor_id', $this->proveedor_id))
                    ->ignore($this->marca->id),
            ],
        ]);

        $this->marca->update([
            'proveedor_id' => $this->proveedor_id,
            'nombre'       => trim(preg_replace('/\s+/', ' ', $this->nombre)),
        ]);

        session()->flash('ok', 'Marca actualizada.');
        return redirect()->route('marcas.index');
    }

    public function render()
    {
        return view('livewire.marcas.editar', [
            'proveedores' => Proveedor::orderBy('nombre')->get(),
        ]);
    }
}
