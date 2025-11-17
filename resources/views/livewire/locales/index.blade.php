<div class="p-6 space-y-6">

  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Locales</h1>
    <a href="{{ route('locales.crear') }}"
       class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">+ Nuevo local</a>
  </div>

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4">
      <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="bg-neutral-50 dark:bg-neutral-800/40 text-neutral-600 dark:text-neutral-300">
          <tr>
            <th class="px-3 py-2 text-left">Nombre</th>
            <th class="px-3 py-2 text-left">Dirección</th>
            <th class="px-3 py-2 text-left">Activo</th>
            <th class="px-3 py-2 text-right">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-neutral-100 dark:divide-neutral-800">
          @forelse($rows as $r)
            <tr>
              <td class="px-3 py-2">{{ $r->nombre }}</td>
              <td class="px-3 py-2">{{ $r->direccion ?? '—' }}</td>
              <td class="px-3 py-2">
                @if($r->activo)
                  <span class="px-2 py-0.5 rounded text-xs bg-green-200 text-green-900 dark:bg-green-500/20 dark:text-green-300">Sí</span>
                @else
                  <span class="px-2 py-0.5 rounded text-xs bg-neutral-200 text-neutral-800 dark:bg-neutral-700 dark:text-neutral-100">No</span>
                @endif
              </td>
              <td class="px-3 py-2 text-right space-x-2">
                <a href="{{ route('locales.editar', $r->id) }}" class="text-indigo-600 hover:underline">Editar</a>
                <button wire:click="toggleActivo({{ $r->id }})" class="text-amber-600 hover:underline">
                  {{ $r->activo ? 'Desactivar' : 'Activar' }}
             <button
  onclick="if(!confirm('¿Eliminar este local?')) { event.stopImmediatePropagation(); event.preventDefault(); }"
  wire:click="delete({{ $r->id }})"
  class="text-rose-600 hover:underline">
  Eliminar
</button>

              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="px-3 py-8 text-center text-neutral-500">No hay locales.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">
      {{ $rows->links() }}
    </div>
  </div>

  {{-- Handler simple para el botón Eliminar --}}
</div>
