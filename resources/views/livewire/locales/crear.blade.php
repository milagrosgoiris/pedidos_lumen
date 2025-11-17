<div class="p-6 space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Nuevo local</h1>
    <a href="{{ route('locales.index') }}" class="text-sm text-neutral-600 hover:underline">← Volver</a>
  </div>

  @if (session('ok'))
    <div class="rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700">
      {{ session('ok') }}
    </div>
  @endif

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4">
    <form wire:submit.prevent="save" class="space-y-4">
      <div>
        <label class="block text-sm text-neutral-600 mb-1">Nombre</label>
        <input type="text" wire:model.defer="nombre" class="w-full border rounded-lg px-3 py-2">
        @error('nombre') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block text-sm text-neutral-600 mb-1">Dirección</label>
        <input type="text" wire:model.defer="direccion" class="w-full border rounded-lg px-3 py-2">
        @error('direccion') <p class="text-sm text-rose-600 mt-1">{{ $message }}</p> @enderror
      </div>

      <label class="inline-flex items-center gap-2">
        <input type="checkbox" wire:model="activo" class="h-4 w-4">
        <span class="text-sm">Activo</span>
      </label>

      <div class="pt-2">
        <button type="submit" class="rounded-lg bg-neutral-900 text-white px-4 py-2 hover:bg-neutral-800">
          Guardar
        </button>
      </div>
    </form>
  </div>
</div>

