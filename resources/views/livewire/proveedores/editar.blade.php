<div class="max-w-xl mx-auto p-6 space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Editar marca</h1>
    <a href="{{ route('marcas.index') }}" class="text-sm text-neutral-600 hover:underline">← Volver</a>
  </div>

  @if (session('ok'))
    <div class="rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
      {{ session('ok') }}
    </div>
  @endif

  <form wire:submit.prevent="update" class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4 space-y-4">
    <div>
      <label class="block text-sm text-neutral-600 dark:text-neutral-300 mb-1">Proveedor</label>
      <select wire:model="proveedor_id" class="w-full border rounded-lg px-3 py-2 bg-white/90 dark:bg-neutral-900/80">
        <option value="">Seleccioná…</option>
        @foreach($opcionesProveedores as $opt)
          <option value="{{ $opt['id'] }}">{{ $opt['nombre'] }}</option>
        @endforeach
      </select>
      @error('proveedor_id') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="block text-sm text-neutral-600 dark:text-neutral-300 mb-1">Nombre</label>
      <input type="text" wire:model.defer="nombre" class="w-full border rounded-lg px-3 py-2 bg-white/90 dark:bg-neutral-900/80" placeholder="Ej: Lario">
      @error('nombre') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center gap-2">
      <input id="chk-activo" type="checkbox" wire:model="activo" class="h-4 w-4">
      <label for="chk-activo" class="text-sm text-neutral-700 dark:text-neutral-300">Activo</label>
    </div>

    <div class="pt-2">
      <button class="rounded-xl bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">
        Guardar cambios
      </button>
    </div>
  </form>
</div>
