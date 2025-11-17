<?php

namespace App\Livewire\Marcas;

use App\Models\Marca;
use App\Models\Proveedor;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $q = '';
    public ?int $proveedorId = null;

    protected $queryString = [
        'q' => ['except' => ''],
        'proveedorId' => ['except' => null],
    ];

    public function updatingQ()          { $this->resetPage(); }
    public function updatingProveedorId(){ $this->resetPage(); }


    public function delete(int $id): void
    {
        if ($m = Marca::find($id)) {
            $m->delete();
        }
    }

    public function render()
    {
        $rows = Marca::query()
            ->with('proveedor:id,nombre')
            ->when($this->q !== '', fn($q) =>
                $q->where('nombre','like',"%{$this->q}%")
            )
            ->when($this->proveedorId, fn($q) =>
                $q->where('proveedor_id', $this->proveedorId)
            )
            ->orderBy('nombre')
            ->paginate(10);

        return view('livewire.marcas.index', [
            'rows'        => $rows,
            'proveedores' => Proveedor::orderBy('nombre')->get(['id','nombre']),
        ])->layout('layouts.app', ['title' => 'Marcas']);
    }
}
