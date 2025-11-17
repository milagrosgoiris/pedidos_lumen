<div class="min-h-screen bg-gradient-to-br from-[#0b0b0f] via-[#111113] to-[#18181b] text-neutral-200 px-8 py-10 space-y-10">

  {{-- ENCABEZADO --}}
  <div class="flex items-center justify-between">
    <h1 class="text-3xl font-semibold text-neutral-100 flex items-center gap-2">
      <x-heroicon-o-chart-bar class="w-7 h-7 text-indigo-400" />
      Panel general
    </h1>
    <a href="{{ route('pedidos.crear') }}"
       class="px-5 py-2 rounded-xl bg-indigo-600 text-white font-medium shadow-md hover:bg-indigo-700 transition">
      + Nuevo Pedido
    </a>
  </div>

  {{-- TARJETAS DE ESTADÍSTICAS --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
    <x-dashboard.card title="Productos" :value="$productos" icon="cube" />
    <x-dashboard.card title="Proveedores" :value="$proveedores" icon="truck" />
    <x-dashboard.card title="Locales" :value="$locales" icon="store" />
    <x-dashboard.card title="Pendientes" :value="$pendientes" icon="clock"
                      badge="Solicitado / Enviado" badge-color="bg-amber-500/80" />
    <x-dashboard.card title="Pedidos hoy" :value="$hoy" icon="calendar"
                      subtitle="{{ now()->format('d/m') }}" />
    <x-dashboard.card title="Total pedidos" :value="$totalPedidos" icon="clipboard-list" />
  </div>

  {{-- ACCESOS RÁPIDOS --}}
  <div class="grid grid-cols-2 md:grid-cols-4 gap-5 pt-6">
    <a href="{{ route('pedidos.index') }}" class="quick-link">
      📦<span>Pedidos</span>
    </a>
    <a href="{{ route('productos.index') }}" class="quick-link">
      🧾<span>Productos</span>
    </a>
    <a href="{{ route('proveedores.index') }}" class="quick-link">
      🚚<span>Proveedores</span>
    </a>
    <a href="{{ route('locales.index') }}" class="quick-link">
      🏪<span>Locales</span>
    </a>
  </div>

  {{-- PEDIDOS RECIENTES --}}
  <div class="bg-neutral-900 border border-neutral-800 rounded-2xl shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-lg font-semibold text-neutral-100 flex items-center gap-2">
        <x-heroicon-o-clipboard-document-list class="w-5 h-5 text-indigo-400" />
        Pedidos recientes
      </h2>
      <a href="{{ route('pedidos.index') }}" class="text-indigo-400 text-sm hover:underline">Ver todos</a>
    </div>

    @if ($pedidos->isEmpty())
      <p class="text-neutral-500 text-sm px-2 py-4">No hay pedidos aún.</p>
    @else
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm border-collapse">
          <thead class="text-neutral-400 border-b border-neutral-800">
            <tr>
              <th class="text-left py-2 px-3">#</th>
              <th class="text-left py-2 px-3">Tipo</th>
              <th class="text-left py-2 px-3">Origen/Destino</th>
              <th class="text-left py-2 px-3">Proveedor</th>
              <th class="text-left py-2 px-3">Estado</th>
              <th class="text-left py-2 px-3">Fecha</th>
              <th class="text-right py-2 px-3">Acciones</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-neutral-800">
            @foreach ($pedidos as $p)
              <tr class="hover:bg-neutral-800/50 transition">
                <td class="py-2 px-3 text-neutral-300">{{ $p->id }}</td>
                <td class="py-2 px-3 text-neutral-300">{{ ucfirst($p->tipo) }}</td>
                <td class="py-2 px-3 text-neutral-300">{{ $p->origen_destino ?? '-' }}</td>
                <td class="py-2 px-3 text-neutral-300">{{ $p->proveedor?->nombre ?? '-' }}</td>
                <td class="py-2 px-3">
                  <span class="px-2 py-1 rounded text-xs bg-indigo-600/40 text-indigo-300">
                    {{ ucfirst($p->estado) }}
                  </span>
                </td>
                <td class="py-2 px-3 text-neutral-400">{{ $p->created_at->format('d/m') }}</td>
                <td class="py-2 px-3 text-right">
                  <a href="{{ route('pedidos.ver', $p) }}" class="text-indigo-400 hover:underline">Ver</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
</div>

{{-- ESTILOS PERSONALIZADOS --}}
@push('styles')
<style>
.quick-link {
  @apply flex flex-col items-center justify-center gap-2 p-5 rounded-xl
         bg-neutral-900 border border-neutral-800
         text-neutral-300 font-medium hover:bg-neutral-800/80 hover:text-white transition;
}
.quick-link span {
  @apply text-sm font-semibold text-indigo-400;
}
</style>
@endpush
