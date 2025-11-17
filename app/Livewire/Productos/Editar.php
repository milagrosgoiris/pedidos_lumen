<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use App\Models\Marca;
use Livewire\Component;

class Editar extends Component
{
    public Producto $producto;

    public string $nombre = '';
    public ?int   $marca_id = null;
    public string $unidad_base = 'unidad';
    public bool   $activo = true;

    public function mount(Producto $producto): void
    {
        $this->producto     = $producto;
        $this->nombre       = (string) $producto->nombre;
        $this->marca_id     = $producto->marca_id;
        $this->unidad_base  = $producto->unidad_base ?? 'unidad';
        $this->activo       = (bool) $producto->activo;
    }

    protected function rules(): array
    {
        return [
            'nombre'       => ['required', 'string', 'max:150'],
            'marca_id'     => ['nullable', 'exists:marcas,id'],
            'unidad_base'  => ['required', 'string', 'max:30'],
            'activo'       => ['boolean'],
        ];
    }

    public function update()
    {
        $data = $this->validate();
        $this->producto->update($data);

        session()->flash('ok', 'Producto actualizado.');
        return redirect()->route('productos.index');
    }

public function render()
{
    return view('livewire.productos.editar', [
        'marcas' => Marca::orderBy('nombre')->get(),
    ])->layout('layouts.app', ['title' => 'Editar producto']);
}

}
