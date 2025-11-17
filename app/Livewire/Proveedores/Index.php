<?php

namespace App\Livewire\Proveedores;

use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $q = '';

    protected $queryString = ['q'];

    public function updatingQ()
    {
        $this->resetPage();
    }

    public function toggleActivo(int $id): void
    {
        $p = Proveedor::findOrFail($id);
        $p->activo = ! (bool) $p->activo;
        $p->save();

        session()->flash('ok', 'Estado actualizado.');
    }

    public function delete(int $id): void
    {
        $p = Proveedor::findOrFail($id);

        // Seguridad: si tiene marcas/productos asociados, no permitir borrar
        if (method_exists($p, 'marcas') && $p->marcas()->exists()) {
            session()->flash('err', 'No se puede eliminar: el proveedor tiene marcas asociadas.');
            return;
        }
        if (method_exists($p, 'productos') && $p->productos()->exists()) {
            session()->flash('err', 'No se puede eliminar: el proveedor tiene productos asociados.');
            return;
        }

        $p->delete();
        session()->flash('ok', 'Proveedor eliminado.');
        $this->resetPage();
    }

    public function render()
{
    $rows = Proveedor::query()
        ->when($this->q !== '', function ($q) {
            $q->where('nombre', 'like', "%{$this->q}%");
        })
        ->orderBy('nombre')
        ->paginate(10);

    return view('livewire.proveedores.index', compact('rows'))
        ->layout('layouts.app') // ✅ asegúrate de que existe resources/views/layouts/app.blade.php
        ->title('Proveedores');
    }
}
