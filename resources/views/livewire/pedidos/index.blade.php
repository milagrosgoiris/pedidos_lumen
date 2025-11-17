<div class="p-6 space-y-6">

  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Pedidos</h1>

    <div class="flex items-center gap-3">
      <input
        type="text"
        placeholder="Buscar por #ID"
        wire:model.debounce.400ms="q"
        class="w-64 rounded-lg border border-neutral-300 dark:border-neutral-700
               bg-white dark:bg-neutral-900 text-neutral-900 dark:text-neutral-100
               placeholder-neutral-400 dark:placeholder-neutral-500 px-3 py-2"
      />

      <a href="{{ route('pedidos.crear') }}"
         class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">
        + Nuevo
      </a>
    </div>
  </div>

  <div class="rounded-xl border border-neutral-200 dark:border-neutral-800
              bg-white dark:bg-neutral-900 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-neutral-50 dark:bg-neutral-800/40
                       text-neutral-600 dark:text-neutral-300">
          <tr>
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Tipo</th>
            <th class="px-4 py-2 text-left">Origen → Destino</th>
            <th class="px-4 py-2 text-left">Proveedor</th>
            <th class="px-4 py-2 text-right">Total Est.</th>
            <th class="px-4 py-2 text-left">Estado</th>
            <th class="px-4 py-2 text-left">Fecha</th>
          </tr>
        </thead>

        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800
                       text-neutral-900 dark:text-neutral-100">
          @forelse($rows as $p)
            <tr class="hover:bg-neutral-50/70 dark:hover:bg-neutral-800/40 transition">
              <td class="px-4 py-2">#{{ $p->id }}</td>
              <td class="px-4 py-2">{{ $p->tipo==1 ? 'A proveedor' : 'Entre locales' }}</td>
              <td class="px-4 py-2">
                @if($p->tipo==2)
                  {{ $p->origen?->nombre ?? '—' }} → {{ $p->destino?->nombre ?? '—' }}
                @else
                  Destino: {{ $p->destino?->nombre ?? '—' }}
                @endif
              </td>
              <td class="px-4 py-2">{{ $p->proveedor?->nombre ?? '—' }}</td>
              <td class="px-4 py-2 text-right">
                {{ $p->total_estimado ? number_format($p->total_estimado,2) : '—' }}
              </td>
              <td class="px-4 py-2">
                @php
                  $label = [0=>'Borrador',1=>'Solicitado',2=>'Aprobado',3=>'Preparado',4=>'Enviado',5=>'Recibido',9=>'Cancelado'][$p->estado] ?? '—';
                  $badge = match((int)$p->estado){
                    0=>'bg-neutral-200 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-100',
                    1=>'bg-amber-200 text-amber-900 dark:bg-amber-500/20 dark:text-amber-300',
                    4=>'bg-blue-200 text-blue-900 dark:bg-blue-500/20 dark:text-blue-300',
                    5=>'bg-green-200 text-green-900 dark:bg-green-500/20 dark:text-green-300',
                    9=>'bg-rose-200 text-rose-900 dark:bg-rose-500/20 dark:text-rose-300',
                    default=>'bg-neutral-200 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-100'
                  };
                @endphp
                <span class="px-2 py-0.5 rounded text-xs {{ $badge }}">{{ $label }}</span>
              </td>
              <td class="px-4 py-2">{{ $p->created_at->format('d/m H:i') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="px-4 py-10 text-center
                                     text-neutral-500 dark:text-neutral-400">
                Sin pedidos…
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="px-4 py-3">
      {{ $rows->links() }}
    </div>
  </div>
</div>
