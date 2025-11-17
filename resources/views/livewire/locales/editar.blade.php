<div class="p-6 max-w-xl space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Editar local</h1>
    <a href="{{ route('locales.index') }}" class="text-sm text-neutral-600 hover:underline">← Volver</a>
  </div>

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4 space-y-4">
    <div>
      <label class="text-sm text-neutral-600">Nombre</label>
      <input type="text" wire:model="nombre" class="w-full border rounded-lg px-3 py-2">
      @error('nombre')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="text-sm text-neutral-600">Dirección</label>
      <input type="text" wire:model="direccion" class="w-full border rounded-lg px-3 py-2">
      @error('direccion')<p class="text-sm text-rose-600 mt-1">{{ $message }}</p>@enderror
    </div>

    <label class="inline-flex items-center gap-2">
      <input type="checkbox" wire:model="activo" class="h-4 w-4">
      <span class="text-sm">Activo</span>
    </label>

    <div class="pt-2">
      <button wire:click="update"
              class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700">
        Actualizar
      </button>
    </div>
  </div>
</div>
