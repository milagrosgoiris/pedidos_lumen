<div class="p-6 space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Marcas</h1>
    <a href="{{ route('marcas.crear') }}"
       class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">+ Nueva marca</a>
  </div>

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4 space-y-4">
    {{-- Filtros --}}
    <div class="flex flex-col md:flex-row md:items-center gap-3">
      <input type="text"
             wire:model.debounce.400ms="q"
             placeholder="Buscar marca…"
             class="w-full md:w-96 border rounded-lg px-3 py-2 bg-white/90 dark:bg-neutral-900/80">
      <div class="flex items-center gap-2">
        <label class="text-sm text-neutral-500 dark:text-neutral-400">Proveedor</label>
        <select wire:model="proveedorId"
                class="border rounded-lg px-3 py-2 bg-white/90 dark:bg-neutral-900/80">
          <option value="">Todas</option>
          @foreach($proveedores as $prov)
            <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-neutral-50 dark:bg-neutral-800/40 text-neutral-600 dark:text-neutral-300">
          <tr>
            <th class="px-3 py-2 text-left">Nombre</th>
            <th class="px-3 py-2 text-left">Proveedor</th>
            <th class="px-3 py-2 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
          @forelse($rows as $r)
            <tr>
              <td class="px-3 py-2 font-medium">{{ $r->nombre }}</td>
              <td class="px-3 py-2">
                <a class="text-indigo-600 hover:underline"
                   href="{{ route('proveedores.index', ['q' => $r->proveedor?->nombre]) }}">
                  {{ $r->proveedor->nombre ?? '—' }}
                </a>
              </td>
              <td class="px-3 py-2 text-right space-x-3">
                <a href="{{ route('marcas.editar', $r->id) }}" class="text-indigo-600 hover:underline">Editar</a>
                <a href="{{ route('productos.index', ['marca_id' => $r->id]) }}" class="text-blue-600 hover:underline">Productos</a>
                <button wire:click="delete({{ $r->id }})"
                        onclick="return confirm('¿Eliminar la marca {{ $r->nombre }}?')"
                        class="text-rose-600 hover:underline">Eliminar</button>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-3 py-10">
                <div class="text-center text-neutral-500">
                  <div class="mb-2">No hay marcas.</div>
                  <a href="{{ route('marcas.crear') }}"
                     class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 text-white px-3 py-1.5 hover:bg-indigo-700">
                    Crear la primera marca
                  </a>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div>{{ $rows->links() }}</div>
  </div>
</div>
