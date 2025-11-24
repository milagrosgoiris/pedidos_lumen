<?php
namespace App\Livewire\Pedidos;

use App\Models\Local;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Marca;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Crear extends Component
{
    public int $tipo = 1;
    public ?int $proveedor_id = null;
    public ?int $origen_local_id = null;
    public ?int $destino_local_id = null;

    public array $items = [
        ['producto_id' => null, 'marca' => '', 'cantidad' => 1],
    ];

    public function addItem(): void
    {
        $this->items[] = ['producto_id' => null, 'marca' => '', 'cantidad' => 1];
    }

    public function removeItem(int $i): void
    {
        unset($this->items[$i]);
        $this->items = array_values($this->items);
    }

    // 🔥 Esta función actualiza la marca al cambiar el producto
    public function updatedItems($value, $key)
    {
        if (str_contains($key, 'producto_id')) {
            $index = explode('.', $key)[0];
            $producto = Producto::with('marca')->find($value);

            if ($producto && isset($this->items[$index])) {
                $this->items[$index]['marca'] = $producto->marca?->nombre ?? '';
            }
        }
    }

    public function save(): void
    {
        $this->validate([
            'tipo'               => 'required|in:1,2',
            'proveedor_id'       => 'nullable|exists:proveedores,id',
            'origen_local_id'    => 'nullable|exists:locales,id',
            'destino_local_id'   => 'nullable|exists:locales,id',
            'items.*.producto_id'=> 'required|exists:productos,id',
            'items.*.cantidad'   => 'required|numeric|min:1',
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
                    'pedido_id'   => $pedido->id,
                    'producto_id' => $it['producto_id'],
                    'cantidad'    => $it['cantidad'],
                ]);
            }

            $this->redirectRoute('pedidos.ver', ['pedido' => $pedido->id], navigate: true);
        });
    }

    public function render()
    {
        return view('livewire.pedidos.crear', [
            'productos'   => Producto::with('marca')->orderBy('nombre')->get(['id','nombre','marca_id']),
            'marcas'      => Marca::with('productos')->orderBy('nombre')->get(['id','nombre']),
            'proveedores' => Proveedor::orderBy('nombre')->get(['id','nombre']),
            'locales'     => Local::orderBy('nombre')->get(['id','nombre']),
        ])->layout('layouts.app', ['title' => 'Nuevo Pedido']);
    }
}
