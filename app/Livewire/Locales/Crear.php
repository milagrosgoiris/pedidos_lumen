<?php

namespace App\Livewire\Locales;

use App\Models\Local;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Crear extends Component
{
    public string $nombre = '';
    public ?string $direccion = null;
    public bool $activo = true;

    protected array $rules = [
        'nombre'    => 'required|string|max:120',
        'direccion' => 'nullable|string|max:255',
        'activo'    => 'boolean',
    ];

    public function save(): void
    {
        $this->validate();

        Local::create([
            'nombre'    => $this->nombre,
            'direccion' => $this->direccion,
            'activo'    => (bool) $this->activo,
        ]);

        session()->flash('ok', 'Local creado');
        $this->redirectRoute('locales.index', navigate: true);
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.locales.crear');
    }
}
