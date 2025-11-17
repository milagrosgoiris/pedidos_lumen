<div class="p-6 space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Proveedores</h1>

    {{-- Botón "Nuevo proveedor" (si todavía no tenés la pantalla, dejalo pero no va a romper) --}}
    <a href="{{ route('proveedores.crear') }}"
       class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">
      + Nuevo proveedor
    </a>
  </div>

  @if (session('ok'))
    <div class="rounded-lg bg-emerald-100 text-emerald-900 px-3 py-2">{{ session('ok') }}</div>
  @endif
  @if (session('err'))
    <div class="rounded-lg bg-rose-100 text-rose-900 px-3 py-2">{{ session('err') }}</div>
  @endif

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4">
    <div class="flex items-center gap-3 mb-4">
      <input type="text" wire:model.debounce.400ms="q"
             placeholder="Buscar proveedor…"
             class="w-full md:w-96 border rounded-lg px-3 py-2 bg-white/90 dark:bg-neutral-900/80">
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-neutral-50 dark:bg-neutral-800/40 text-neutral-600 dark:text-neutral-300">
          <tr>
            <th class="px-3 py-2 text-left">Nombre</th>
            <th class="px-3 py-2 text-left">Activo</th>
            <th class="px-3 py-2 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
          @forelse($rows as $p)
            <tr>
              <td class="px-3 py-2 font-medium">{{ $p->nombre }}</td>
              <td class="px-3 py-2">
                @if($p->activo)
                  <span class="px-2 py-0.5 rounded text-xs bg-green-200 text-green-900 dark:bg-green-500/20 dark:text-green-300">Sí</span>
                @else
                  <span class="px-2 py-0.5 rounded text-xs bg-neutral-200 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-100">No</span>
                @endif
              </td>
              <td class="px-3 py-2">
                <div class="flex items-center justify-end gap-3">
                  <a class="text-indigo-600 hover:underline"
                     href="{{ route('marcas.index', ['proveedorId' => $p->id]) }}">
                    Ver marcas
                  </a>

                  <a class="text-blue-600 hover:underline"
                     href="{{ route('marcas.crear', ['proveedor_id' => $p->id]) }}">
                    Agregar marca
                  </a>

                  {{-- Opcional: si tenés la pantalla de editar proveedor --}}
                  @if (Route::has('proveedores.editar'))
                    <a class="text-amber-600 hover:underline"
                       href="{{ route('proveedores.editar', $p->id) }}">Editar</a>
                  @endif

                  <button class="text-sky-700 hover:underline"
                          wire:click="toggleActivo({{ $p->id }})">
                    {{ $p->activo ? 'Desactivar' : 'Activar' }}
                  </button>

                  <button class="text-rose-600 hover:underline"
                          wire:click="delete({{ $p->id }})"
                          wire:confirm="¿Eliminar definitivamente el proveedor «{{ $p->nombre }}»?">
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="px-3 py-10 text-center text-neutral-500">
                Sin proveedores.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">{{ $rows->links() }}</div>
  </div>
</div>
