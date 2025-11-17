<div class="p-6 space-y-6">

  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Productos</h1>
    <a href="{{ route('productos.crear') }}"
       class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">+ Nuevo producto</a>
  </div>

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4">
    @if (session('ok'))
      <div class="mb-3 rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
        {{ session('ok') }}
      </div>
    @endif

    <div class="flex items-center gap-3 mb-4">
      <input type="text" wire:model.debounce.400ms="q"
             placeholder="Buscar por nombre, marca o unidad…"
             class="w-full md:w-96 border rounded-lg px-3 py-2">
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-neutral-50 dark:bg-neutral-800/40 text-neutral-600 dark:text-neutral-300">
          <tr>
            <th class="px-3 py-2 text-left">Nombre</th>
            <th class="px-3 py-2 text-left">Marca</th>
            <th class="px-3 py-2 text-left">Unidad</th>
            <th class="px-3 py-2 text-left">Activo</th>
            <th class="px-3 py-2 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
          @forelse($rows as $r)
            <tr>
              <td class="px-3 py-2">{{ $r->nombre }}</td>
              <td class="px-3 py-2">{{ $r->marca?->nombre ?? '—' }}</td>
              <td class="px-3 py-2">{{ $r->unidad_base ?? '—' }}</td>
              <td class="px-3 py-2">
                @if($r->activo)
                  <span class="px-2 py-0.5 rounded text-xs bg-green-200 text-green-900 dark:bg-green-500/20 dark:text-green-300">Sí</span>
                @else
                  <span class="px-2 py-0.5 rounded text-xs bg-neutral-200 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-100">No</span>
                @endif
              </td>
              <td class="px-3 py-2 text-right space-x-2">
                <a href="{{ route('productos.editar', $r->id) }}" class="text-indigo-600 hover:underline">Editar</a>

                <button wire:click="toggleActivo({{ $r->id }})" class="text-amber-600 hover:underline">
                  {{ $r->activo ? 'Desactivar' : 'Activar' }}
                </button>

                <button
                  wire:click="delete({{ $r->id }})"
                  onclick="if(!confirm('¿Eliminar este producto?')) { event.stopImmediatePropagation(); }"
                  class="text-rose-600 hover:underline">
                  Eliminar
                </button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="px-3 py-8 text-center text-neutral-500">No hay productos.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $rows->links() }}
    </div>
  </div>
</div>
