<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $q = '';

    protected $queryString = ['q'];

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function toggleActivo(int $id): void
    {
        $p = Producto::findOrFail($id);
        $p->update(['activo' => ! (bool) $p->activo]);
        session()->flash('ok', 'Estado actualizado.');
    }

    public function delete(int $id): void
    {
        // Si usás SoftDeletes, considerá ->forceDelete()
        Producto::findOrFail($id)->delete();
        session()->flash('ok', 'Producto eliminado.');
        // $this->resetPage(); // opcional
    }

public function render()
{
    $rows = Producto::query()
        ->with('marca:id,nombre')
        ->when($this->q, function ($q) {
            $q->where('nombre', 'like', '%'.$this->q.'%')
              ->orWhereHas('marca', fn($m) => $m->where('nombre', 'like', '%'.$this->q.'%'))
              ->orWhere('unidad_base','like','%'.$this->q.'%');
        })
        ->orderBy('nombre')
        ->paginate(10);

    return view('livewire.productos.index', compact('rows'))
        ->layout('layouts.app', ['title' => 'Productos']);
}
}