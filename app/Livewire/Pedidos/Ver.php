<?php

namespace App\Livewire\Pedidos;

use Livewire\Component;
use App\Models\Pedido as PedidoModel;
use App\Models\Producto;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\Local;

class Ver extends Component
{
    public PedidoModel $pedido;

    public function mount(PedidoModel $pedido)
    {
        // Cargamos las relaciones necesarias para mostrar el pedido
        $this->pedido = $pedido->load([
            'origen',
            'destino',
            'proveedor',
            'items.producto.marca'
        ]);
    }
public function cambiarEstado($nuevo)
{
    $this->pedido->estado = $nuevo;
    $this->pedido->save();

    session()->flash('success', 'Estado actualizado correctamente.');
}

    public function render()
    {
        return view('livewire.pedidos.ver', [
            'pedido' => $this->pedido,
        ])->layout('layouts.app', ['title' => 'Ver Pedido']);
    }
}
