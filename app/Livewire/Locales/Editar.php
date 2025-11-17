<?php

namespace App\Livewire\Locales;

use App\Models\Local;
use Livewire\Component;

class Editar extends Component
{
    public Local $local;

    public string $nombre = '';
    public string $direccion = '';
    public bool $activo = true;

    public function mount(Local $local): void
    {
        $this->local     = $local;
        $this->nombre    = (string) $local->nombre;
        $this->direccion = (string) ($local->direccion ?? '');
        $this->activo    = (bool) $local->activo;
    }

    public function update(): void
    {
        $this->validate([
            'nombre'    => 'required|string|max:120|unique:locales,nombre,' . $this->local->id,
            'direccion' => 'nullable|string|max:255',
            'activo'    => 'boolean',
        ]);

        $this->local->update([
            'nombre'    => $this->nombre,
            'direccion' => $this->direccion ?: null,
            'activo'    => $this->activo,
        ]);

        $this->redirectRoute('locales.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.locales.editar')
            ->layout('layouts.app', ['title' => "Editar local #{$this->local->id}"]);
    }
}
