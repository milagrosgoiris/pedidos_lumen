<?php

namespace App\Http\Controllers;

use App\Models\Pedido;

class PedidoPrintController extends Controller
{
    public function show(Pedido $pedido)
    {
        $pedido->load([
            'proveedor:id,nombre',
            'origen:id,nombre',
            'destino:id,nombre',
            'items.producto:id,nombre,unidad_base',
            'comentarios.user:id,name',
        ]);

        return view('pedidos.print', compact('pedido'));
    }
}
