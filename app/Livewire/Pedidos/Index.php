<?php

namespace App\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $q = '';

    public function updatingQ(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $rows = Pedido::with(['proveedor:id,nombre','origen:id,nombre','destino:id,nombre'])
            ->when($this->q !== '', fn ($q) => $q->where('id', $this->q))
            ->latest('id')
            ->paginate(10);

        return view('livewire.pedidos.index', compact('rows'))
            ->layout('layouts.app', ['title' => 'Pedidos']);
    }
}
