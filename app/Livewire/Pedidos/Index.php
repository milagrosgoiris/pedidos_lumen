<?php

namespace App\Livewire\Pedidos;

use App\Models\Pedido;
use Livewire\Component;

class Index extends Component
{
    public $search = '';

    public function render()
    {
        $pedidos = Pedido::with(['origen', 'destino', 'proveedor'])
            ->where(function ($query) {
                $query->where('id', 'like', "%{$this->search}%")
                      ->orWhereHas('proveedor', fn($q) => $q->where('nombre', 'like', "%{$this->search}%"))
                      ->orWhereHas('origen', fn($q) => $q->where('nombre', 'like', "%{$this->search}%"))
                      ->orWhereHas('destino', fn($q) => $q->where('nombre', 'like', "%{$this->search}%"));
            })
            ->orderByDesc('id')
            ->get();

        return view('livewire.pedidos.index', [
            'pedidos' => $pedidos,
        ])->layout('layouts.app', ['title' => 'Pedidos']);
    }
}
