<?php

namespace App\Livewire\Pedidos;

use App\Models\Local;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Crear extends Component
{
    public int $tipo = 1; // 1 proveedor, 2 entre locales
    public ?int $proveedor_id = null;
    public ?int $origen_local_id = null;
    public ?int $destino_local_id = null;


    public array $items = [
        ['producto_id' => null, 'cantidad' => 1, 'nota' => null],
    ];

    public function addItem(): void
    {
        $this->items[] = ['producto_id' => null, 'cantidad' => 1, 'nota' => null];
    }

    public function removeItem(int $i): void
    {
        unset($this->items[$i]);
        $this->items = array_values($this->items);
    }

    public function save(): void
    {
        $this->validate([
            'tipo'               => 'required|in:1,2',
            'proveedor_id'       => 'nullable|exists:proveedores,id',
            'origen_local_id'    => 'nullable|exists:locales,id',
            'destino_local_id'   => 'nullable|exists:locales,id',
            'items.*.producto_id'=> 'required|exists:productos,id',
            'items.*.cantidad'   => 'required|numeric|min:0.001',
            'items.*.nota'       => 'nullable|string|max:255',
        ]);

        DB::transaction(function () {
            $pedido = Pedido::create([
                'tipo'            => $this->tipo,
                'proveedor_id'    => $this->tipo === 1 ? $this->proveedor_id : null,
                'origen_local_id' => $this->tipo === 2 ? $this->origen_local_id : null,
                'destino_local_id'=> $this->destino_local_id,
                'estado'          => 0,
                'total_estimado'  => null,
                'creado_por'      => auth()->id(),
            ]);

            foreach ($this->items as $it) {
                PedidoItem::create([
                    'pedido_id'            => $pedido->id,
                    'producto_id'          => $it['producto_id'],
                    'cantidad_solicitada'  => $it['cantidad'],
                    'nota'                 => $it['nota'],
                ]);
            }

            $this->redirectRoute('pedidos.ver', ['pedido' => $pedido->id], navigate: true);
        });
    }

    public function render()
    {
        return view('livewire.pedidos.crear', [
            'productos'   => Producto::orderBy('nombre')->get(['id','nombre','unidad_base']),
            'proveedores' => Proveedor::orderBy('nombre')->get(['id','nombre']),
            'locales'     => Local::orderBy('nombre')->get(['id','nombre']),
        ])->layout('layouts.app', ['title' => 'Nuevo Pedido']);
    }
}
