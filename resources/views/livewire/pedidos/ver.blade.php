<div class="min-h-screen bg-[#0b0b0f] text-neutral-200 p-8 space-y-6">

    {{-- Encabezado principal --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2">
            <h1 class="text-2xl font-semibold flex items-center gap-2">
                Pedido #{{ $pedido->id }}
            </h1>
            <span class="px-2 py-0.5 rounded-lg text-xs font-medium
                @switch($pedido->estado)
                    @case(0) bg-neutral-700 text-neutral-300 @break
                    @case(1) bg-indigo-700 text-indigo-100 @break
                    @case(2) bg-blue-800 text-blue-100 @break
                    @case(3) bg-green-700 text-green-100 @break
                    @case(9) bg-red-700 text-red-100 @break
                @endswitch">
                {{ App\Models\Pedido::labels()[$pedido->estado] ?? '—' }}
            </span>
        </div>

        <div class="flex items-center gap-3">
            @php
                $botones = [
                    0 => ['label' => 'Solicitar', 'color' => 'bg-violet-600 hover:bg-violet-700'],
                    1 => ['label' => 'Enviar', 'color' => 'bg-indigo-600 hover:bg-indigo-700'],
                    2 => ['label' => 'Recibir', 'color' => 'bg-green-600 hover:bg-green-700'],
                    9 => ['label' => 'Cancelado', 'color' => 'bg-red-700'],
                ];
            @endphp

            {{-- Botón siguiente estado --}}
            @if(isset($botones[$pedido->estado]) && $pedido->estado !== 3 && $pedido->estado !== 9)
                <button
                    wire:click="cambiarEstado({{ $pedido->estado + 1 }})"
                    class="{{ $botones[$pedido->estado]['color'] }} text-white px-5 py-1.5 rounded-lg text-sm font-medium transition shadow-md hover:shadow-violet-500/20">
                    {{ $botones[$pedido->estado]['label'] }}
                </button>
            @endif

            {{-- Botón cancelar --}}
            @if($pedido->estado < 3)
                <button
                    wire:click="cambiarEstado(9)"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-1.5 rounded-lg text-sm font-medium transition shadow-md hover:shadow-red-500/20">
                    Cancelar
                </button>
            @endif

            <a href="{{ route('pedidos.index') }}"
               class="text-sm text-neutral-400 hover:text-violet-400 transition ml-2">← Volver</a>
        </div>
    </div>

    {{-- Datos generales --}}
    <div class="bg-[#141418] border border-neutral-800 rounded-xl p-6 shadow-lg shadow-black/30">
        <h2 class="text-lg font-semibold mb-4 text-neutral-100">Detalles del pedido</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-3 text-sm">
            <div>
                <p class="mb-1">
                    <span class="text-neutral-400">🧭 Tipo:</span>
                    <span class="text-neutral-200 font-medium ml-1">
                        {{ $pedido->tipo == 1 ? 'A proveedor' : 'Entre locales' }}
                    </span>
                </p>
                <p class="mb-1">
                    <span class="text-neutral-400">🏪 Origen:</span>
                    <span class="text-neutral-200 ml-1">{{ $pedido->origen?->nombre ?? '—' }}</span>
                </p>
                <p class="mb-1">
                    <span class="text-neutral-400">📦 Destino:</span>
                    <span class="text-neutral-200 ml-1">{{ $pedido->destino?->nombre ?? '—' }}</span>
                </p>
            </div>

            <div>
                <p class="mb-1">
                    <span class="text-neutral-400">🤝 Proveedor:</span>
                    <span class="text-neutral-200 ml-1">{{ $pedido->proveedor?->nombre ?? '—' }}</span>
                </p>
                <p class="mb-1">
                    <span class="text-neutral-400">📅 Creado:</span>
                    <span class="text-neutral-200 ml-1">{{ $pedido->created_at->format('d/m/Y H:i') }}</span>
                </p>
                <p class="mb-1 flex items-center">
                    <span class="text-neutral-400">🚦 Estado actual:</span>
                    <span class="ml-2 px-2 py-0.5 rounded-lg text-xs font-medium
                        @switch($pedido->estado)
                            @case(0) bg-neutral-700 text-neutral-300 @break
                            @case(1) bg-indigo-700 text-indigo-100 @break
                            @case(2) bg-blue-800 text-blue-100 @break
                            @case(3) bg-green-700 text-green-100 @break
                            @case(9) bg-red-700 text-red-100 @break
                        @endswitch">
                        {{ App\Models\Pedido::labels()[$pedido->estado] ?? '—' }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- Ítems agrupados por marca --}}
    <div class="bg-[#141418] border border-neutral-800 rounded-xl p-6 shadow-lg shadow-black/30">
        <h2 class="text-lg font-semibold mb-4 text-neutral-100">Ítems del pedido</h2>

        @php
            $agrupados = $pedido->items->groupBy(fn($item) => $item->producto->marca->nombre ?? 'Sin marca');
        @endphp

        @foreach($agrupados as $marca => $items)
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-2">
                    <span class="px-3 py-1 bg-violet-600/20 text-violet-300 rounded-full text-sm font-medium">
                        {{ $marca }}
                    </span>
                    <span class="text-neutral-500 text-xs">
                        ({{ $items->count() }} producto{{ $items->count() > 1 ? 's' : '' }})
                    </span>
                </div>

                <table class="w-full text-sm border-collapse">
                    <thead class="text-neutral-400 border-b border-neutral-800">
                        <tr>
                            <th class="text-left py-2 px-2">Producto</th>
                            <th class="text-left py-2 px-2 w-32">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-800">
                        @foreach($items as $item)
                            <tr class="hover:bg-neutral-800/50">
                                <td class="py-2 px-2">{{ $item->producto->nombre }}</td>
                                <td class="py-2 px-2">{{ number_format($item->cantidad, 3, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        @if($agrupados->isEmpty())
            <p class="text-neutral-500 text-sm italic">Sin ítems en este pedido.</p>
        @endif
    </div>
</div>
