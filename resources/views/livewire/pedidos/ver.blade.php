<div class="p-6 space-y-6">

  {{-- Header con acciones --}}
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Pedido #{{ $pedido->id }}</h1>

    <div class="flex items-center gap-2">
      @php
        $labels = \App\Models\Pedido::labels();
        $targets = \App\Models\Pedido::transitions()[$pedido->estado] ?? [];
        $mapBtn = [
          1=>['Solicitar','bg-amber-600 hover:bg-amber-700'],
          2=>['Aprobar','bg-blue-600 hover:bg-blue-700'],
          3=>['Preparado','bg-indigo-600 hover:bg-indigo-700'],
          4=>['Enviar','bg-cyan-600 hover:bg-cyan-700'],
          5=>['Recibido','bg-green-600 hover:bg-green-700'],
          9=>['Cancelar','bg-rose-600 hover:bg-rose-700'],
        ];
      @endphp

      {{-- Nota para el cambio de estado (opcional) --}}
      <input type="text" wire:model="nota_estado" placeholder="Nota (opcional)"
             class="hidden md:block border rounded-lg px-3 py-1.5">

      {{-- Botones de transición válidos --}}
      @foreach($targets as $t)
        @php [$txt,$cls] = $mapBtn[$t] ?? [$labels[$t] ?? 'Cambiar','bg-neutral-700 hover:bg-neutral-800']; @endphp
        <button wire:click="cambiarEstado({{ $t }})"
                class="text-white rounded-lg px-3 py-1.5 {{ $cls }}">
          {{ $txt }}
        </button>
      @endforeach

      <a href="{{ route('pedidos.imprimir', $pedido->id) }}" target="_blank"
         class="rounded-lg border px-3 py-1.5 hover:bg-neutral-50">Imprimir</a>

      <a href="{{ route('pedidos.index') }}" class="text-sm text-neutral-600 hover:underline">← Volver</a>
    </div>
  </div>

  {{-- Resumen --}}
  <div class="bg-white rounded-xl shadow p-4 grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
    <div><span class="text-neutral-500">Tipo:</span> <span class="font-medium">{{ $pedido->tipo==1?'A proveedor':'Entre locales' }}</span></div>
    <div><span class="text-neutral-500">Proveedor:</span> {{ $pedido->proveedor->nombre ?? '—' }}</div>
    <div><span class="text-neutral-500">Origen:</span> {{ $pedido->origen->nombre ?? '—' }}</div>
    <div><span class="text-neutral-500">Destino:</span> {{ $pedido->destino->nombre ?? '—' }}</div>
  </div>

 {{-- Ítems (sin precios) --}}
<div class="bg-white rounded-xl shadow overflow-x-auto">
  <table class="min-w-full text-sm">
    <thead>
      <tr class="bg-neutral-50 text-neutral-600">
        <th class="px-3 py-2 text-left">Producto</th>
        <th class="px-3 py-2 text-left">Unidad</th>
        <th class="px-3 py-2 text-left">Cant. solicitada</th>
      </tr>
    </thead>
    <tbody>
      @forelse($pedido->items as $it)
        <tr class="border-t">
          <td class="px-3 py-2">{{ $it->producto->nombre ?? '—' }}</td>
          <td class="px-3 py-2">{{ $it->producto->unidad_base ?? '—' }}</td>
          <td class="px-3 py-2">{{ number_format($it->cantidad_solicitada,3) }}</td>
        </tr>
      @empty
        <tr><td colspan="3" class="px-3 py-6 text-center text-neutral-500">Sin ítems</td></tr>
      @endforelse
    </tbody>
  </table>
</div>


  {{-- Comentarios + Archivos --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Comentarios --}}
    <div class="bg-white rounded-xl shadow p-4">
      <h2 class="font-medium mb-3">Comentarios</h2>

      <div class="space-y-3 max-h-72 overflow-y-auto">
        @forelse($pedido->comentarios as $c)
          <div class="rounded-lg border px-3 py-2">
            <div class="text-sm text-neutral-500">
              {{ $c->user->name ?? 'Usuario' }} — {{ $c->created_at?->format('d/m H:i') }}
            </div>
            <div class="text-sm mt-1">{{ $c->contenido }}</div>
          </div>
        @empty
          <p class="text-sm text-neutral-500">Sin comentarios.</p>
        @endforelse
      </div>

      <div class="mt-3 flex gap-2">
        <input type="text" wire:model="comentario" class="flex-1 border rounded-lg px-3 py-2" placeholder="Escribe un comentario…">
        <button wire:click="addComentario" class="bg-neutral-900 text-white px-3 py-2 rounded-lg">Enviar</button>
      </div>
      @error('comentario')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Archivos --}}
    <div class="bg-white rounded-xl shadow p-4">
      <h2 class="font-medium mb-3">Archivos</h2>

      @if (session('ok'))
        <div class="mb-3 text-sm text-green-700 bg-green-50 border border-green-200 rounded-lg px-3 py-2">
          {{ session('ok') }}
        </div>
      @endif

      <div class="space-y-2">
        @forelse($pedido->archivos as $a)
          <a href="{{ $a->path }}" target="_blank" class="flex items-center justify-between rounded-lg border px-3 py-2 hover:bg-neutral-50">
            <span class="text-sm">{{ $a->titulo ?? basename($a->path) }}</span>
            <span class="text-xs text-neutral-500">{{ $a->tipo }}</span>
          </a>
        @empty
          <p class="text-sm text-neutral-500">Sin archivos adjuntos.</p>
        @endforelse
      </div>

      <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-2 items-end">
        <div class="md:col-span-2">
          <label class="text-sm text-neutral-600">Archivo</label>
          <input type="file" wire:model="archivo" class="w-full border rounded-lg px-3 py-2">
          @error('archivo')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
          <label class="text-sm text-neutral-600">Título (opcional)</label>
          <input type="text" wire:model="archivo_titulo" class="w-full border rounded-lg px-3 py-2">
        </div>
      </div>

      <div class="mt-3">
        <button wire:click="uploadArchivo" class="bg-indigo-600 text-white px-3 py-2 rounded-lg hover:bg-indigo-700">
          Subir archivo
        </button>
        <div wire:loading wire:target="uploadArchivo,archivo" class="text-sm text-neutral-500 mt-1">Subiendo…</div>
      </div>
    </div>
  </div>

  {{-- Historial de estado --}}
  <div class="bg-white rounded-xl shadow p-4">
    <h2 class="font-medium mb-3">Historial de estado</h2>

    @if($pedido->historial->isEmpty())
      <p class="text-sm text-neutral-500">Sin movimientos aún.</p>
    @else
      <ol class="relative border-s border-neutral-200 pl-6">
        @foreach($pedido->historial as $h)
          <li class="mb-4">
            <span class="absolute -left-2 top-1.5 h-3 w-3 rounded-full bg-neutral-300"></span>
            <div class="text-sm">
              <span class="font-medium">{{ \App\Models\Pedido::labels()[$h->estado] ?? $h->estado }}</span>
              <span class="text-neutral-500">— {{ $h->created_at?->format('d/m/Y H:i') }}</span>
            </div>
            <div class="text-sm text-neutral-600">
              {{ $h->user->name ?? 'Sistema' }} @if($h->nota) · <em>{{ $h->nota }}</em> @endif
            </div>
          </li>
        @endforeach
      </ol>
    @endif
  </div>

</div>
