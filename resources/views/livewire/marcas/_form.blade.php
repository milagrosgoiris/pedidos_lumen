{{-- Título de la pestaña del navegador --}}
@push('title')
  <title>Nueva marca</title>
@endpush

<div class="space-y-4">
  {{-- Campo: Proveedor --}}
  <div>
    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
      Proveedor
    </label>
    <select
        wire:model="proveedor_id"
        class="w-full rounded-lg border border-neutral-300 bg-white text-neutral-800
               dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100
               focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 transition">
        <option value="">Seleccioná un proveedor...</option>
        @foreach ($proveedores as $p)
            <option value="{{ $p->id }}">{{ $p->nombre }}</option>
        @endforeach
    </select>
    @error('proveedor_id')
        <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Campo: Nombre de la marca --}}
  <div>
    <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
      Nombre de la marca
    </label>
    <input
        type="text"
        wire:model.defer="nombre"
        class="w-full rounded-lg border border-neutral-300 bg-white text-neutral-800
               dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100
               focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 transition"
        placeholder="Ej: Lario"
        required>
    @error('nombre')
        <p class="text-sm text-rose-500 mt-1">{{ $message }}</p>
    @enderror
  </div>

  {{-- Botones --}}
  <div class="flex items-center gap-3 pt-2">
    <a href="{{ route('marcas.index') }}"
       class="px-4 py-2 rounded-lg border border-neutral-400 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition">
      Cancelar
    </a>
    <button
      type="submit"
      wire:click.prevent="{{ $submitAction }}"
      class="px-4 py-2 rounded-lg bg-indigo-600 text-white font-medium hover:bg-indigo-700 transition">
      {{ $submitLabel }}
    </button>
  </div>
</div>
