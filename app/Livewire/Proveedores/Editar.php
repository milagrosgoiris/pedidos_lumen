<?php

namespace App\Livewire\Proveedores;

use App\Models\Proveedor;
use Livewire\Component;

class Editar extends Component
{
    public $proveedor_id;
    public $nombre;
    public $activo = true;
    public $opcionesProveedores = [];

    public function mount()
    {
        // 🔹 Obtener el ID desde la URL actual
        $id = request()->route('id');

        // Si no hay ID, lanzar error amigable
        if (!$id) {
            abort(404, 'ID de proveedor no especificado.');
        }

        // 🔹 Cargar proveedor actual
        $proveedor = Proveedor::findOrFail($id);

        $this->proveedor_id = $proveedor->id;
        $this->nombre = $proveedor->nombre;
        $this->activo = $proveedor->activo;

        // 🔹 Cargar opciones de proveedores (para el select)
        $this->opcionesProveedores = Proveedor::select('id', 'nombre')->get()->toArray();
    }

    public function update()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'activo' => 'boolean',
        ]);

        $proveedor = Proveedor::findOrFail($this->proveedor_id);

        $proveedor->update([
            'nombre' => $this->nombre,
            'activo' => $this->activo,
        ]);

        session()->flash('ok', 'Proveedor actualizado correctamente.');

        return redirect()->route('proveedores.index');
    }

    public function render()
    {
        return view('livewire.proveedores.editar');
    }
}
