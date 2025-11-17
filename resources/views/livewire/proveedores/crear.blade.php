<div class="max-w-2xl mx-auto space-y-6">
  <h1 class="text-2xl font-semibold">Nuevo proveedor</h1>

  <form wire:submit.prevent="save" class="space-y-4 bg-white dark:bg-neutral-900 p-6 rounded-xl shadow">
    <div>
      <label class="block text-sm mb-1">Nombre *</label>
      <input type="text" wire:model.defer="nombre" class="w-full border rounded px-3 py-2">
      @error('nombre') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
    </div>

    <label class="inline-flex items-center gap-2">
      <input type="checkbox" wire:model.defer="activo" class="h-4 w-4">
      <span>Activo</span>
    </label>

    <div class="pt-2 flex gap-2">
      <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Guardar</button>
      <a href="{{ route('proveedores.index') }}" class="px-4 py-2 border rounded">Cancelar</a>
    </div>
  </form>
</div>
