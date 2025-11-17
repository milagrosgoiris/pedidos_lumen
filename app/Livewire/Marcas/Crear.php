<?php

namespace App\Livewire\Marcas;

use App\Models\Marca;
use App\Models\Proveedor;
use Livewire\Component;

class Crear extends Component
{
    public $nombre;
    public $proveedor_id = '';
    public $activo = true;
    public $proveedores = [];

    public function mount()
    {
        // 🔹 Cargar lista de proveedores para el select
        $this->proveedores = Proveedor::select('id', 'nombre')->get();
    }

    public function save()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        Marca::create([
            'nombre' => $this->nombre,
            'proveedor_id' => $this->proveedor_id,
            'activo' => $this->activo,
        ]);

        session()->flash('ok', 'Marca creada correctamente.');

        return redirect()->route('marcas.index');
    }

    public function render()
{
    return view('livewire.marcas.crear')
        ->layout('layouts.app'); // 👈 cambia esto al path correcto
}

}
