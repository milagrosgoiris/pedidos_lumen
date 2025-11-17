<?php

namespace App\Livewire\Dashboard;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Local;
use App\Models\Pedido;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        // 📊 Datos generales del sistema
        $productos   = Producto::count();
        $proveedores = Proveedor::count();
        $locales     = Local::count();
        $pendientes  = Pedido::whereIn('estado', ['solicitado', 'enviado'])->count();
        $hoy         = Pedido::whereDate('created_at', now())->count();
        $totalPedidos = Pedido::count();

        // 🧾 Pedidos recientes (últimos 5)
        $pedidos = Pedido::latest()->take(5)->get();

        return view('livewire.dashboard.home', [
            'productos'     => $productos,
            'proveedores'   => $proveedores,
            'locales'       => $locales,
            'pendientes'    => $pendientes,
            'hoy'           => $hoy,
            'totalPedidos'  => $totalPedidos,
            'pedidos'       => $pedidos,
        ])->layout('layouts.app', ['title' => 'Dashboard | Pedidos Lumen']);
    }
}

