<div class="min-h-screen bg-[#0b0b0f] text-neutral-200 p-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Pedidos</h1>

        <div class="flex items-center gap-3">
            <input wire:model.live="search" 
                type="text" 
                placeholder="Buscar por #ID" 
                class="bg-neutral-900 border border-neutral-700 text-neutral-200 rounded-lg px-3 py-2 text-sm focus:ring-indigo-500 focus:border-indigo-500" />
            
            <a href="{{ route('pedidos.crear') }}" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                + Nuevo
            </a>
        </div>
    </div>

    {{-- Tabla de pedidos --}}
    <div class="bg-neutral-900 border border-neutral-800 rounded-xl overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-neutral-800 text-neutral-400 uppercase text-xs tracking-wider">
                <tr>
                    <th class="text-left py-3 px-4">#</th>
                    <th class="text-left py-3 px-4">Tipo</th>
                    <th class="text-left py-3 px-4">Origen → Destino</th>
                    <th class="text-left py-3 px-4">Proveedor</th>
                    <th class="text-left py-3 px-4">Estado</th>
                    <th class="text-left py-3 px-4">Fecha</th>
                    <th class="text-right py-3 px-4">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-800">
                @forelse ($pedidos as $pedido)
                    <tr class="hover:bg-neutral-800/60 transition">
                        <td class="py-3 px-4 font-medium text-neutral-400">
                            #{{ $pedido->id }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $pedido->tipo == 1 ? 'A proveedor' : 'Entre locales' }}
                        </td>
                        <td class="py-3 px-4">
                            @if($pedido->tipo == 2)
                                {{ $pedido->origen?->nombre ?? '—' }} → {{ $pedido->destino?->nombre ?? '—' }}
                            @else
                                {{ $pedido->destino?->nombre ?? '—' }}
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            {{ $pedido->proveedor?->nombre ?? '—' }}
                        </td>
                        <td class="py-3 px-4">
                            @php
                                $estado = \App\Models\Pedido::labels()[$pedido->estado] ?? 'Desconocido';
                                $color = match($pedido->estado) {
                                    0 => 'bg-neutral-700 text-neutral-300',   // Borrador
                                    1 => 'bg-blue-700 text-white',           // Solicitado
                                    2 => 'bg-indigo-600 text-white',         // Aprobado
                                    3 => 'bg-amber-600 text-white',          // Preparado
                                    4 => 'bg-sky-600 text-white',            // Enviado
                                    5 => 'bg-green-600 text-white',          // Recibido
                                    9 => 'bg-rose-700 text-white',           // Cancelado
                                    default => 'bg-neutral-700 text-neutral-300',
                                };
                            @endphp
                            <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                {{ $estado }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-neutral-400">
                            {{ $pedido->created_at?->format('d/m H:i') ?? '—' }}
                        </td>
                        <td class="py-3 px-4 text-right">
                            <a href="{{ route('pedidos.ver', $pedido->id) }}" 
                                class="text-indigo-400 hover:text-indigo-300 text-sm font-medium">
                                Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-6 text-center text-neutral-500">
                            Sin pedidos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
