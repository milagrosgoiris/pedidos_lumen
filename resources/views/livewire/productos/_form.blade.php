<form wire:submit.prevent="{{ $action }}" class="space-y-4">
  @if (session('ok'))
    <div class="rounded-lg border border-green-200 bg-green-50 px-3 py-2 text-sm text-green-700 dark:border-green-700 dark:bg-green-950 dark:text-green-200">
      {{ session('ok') }}
    </div>
  @endif

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Nombre --}}
    <div>
      <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Nombre</label>
      <input type="text"
             wire:model.defer="nombre"
             class="w-full rounded-lg border border-neutral-300 bg-white text-neutral-800
                    dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100
                    focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 transition"
             placeholder="Ej: Jamón cocido">
      @error('nombre')
        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Marca --}}
    <div>
      <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">Marca</label>
      <select
          wire:model="marca_id"
          class="w-full rounded-lg border border-neutral-300 bg-white text-neutral-800
                 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100
                 focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 transition">
        <option value="">— Sin marca —</option>
        @foreach($marcas as $m)
          <option value="{{ $m->id }}">{{ $m->nombre }}</option>
        @endforeach
      </select>
      @error('marca_id')
        <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
      @enderror
    </div>

    {{-- Unidad base --}}
 <div>
  <label class="block text-sm font-medium text-neutral-700 dark:text-neutral-300 mb-1">
    Unidad base
  </label>
  <select
      wire:model="unidad_base"
      class="w-full rounded-lg border border-neutral-300 bg-white text-neutral-800
             dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-100
             focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 transition">
      <option value="">Seleccioná...</option>
      <option value="u">Unidad</option>
      <option value="kg">Kilogramo (kg)</option>
      <option value="l">Litro (l)</option>
      <option value="caja">Caja</option>
      <option value="pack">Pack</option>
  </select>
  @error('unidad_base')
    <p class="text-sm text-rose-600 mt-1">{{ $message }}</p>
  @enderror
</div>


    {{-- Activo --}}
    <div class="flex items-center gap-2 mt-6">
      <input type="checkbox"
             wire:model="activo"
             class="h-4 w-4 border-neutral-400 dark:border-neutral-600 bg-white dark:bg-neutral-900 text-indigo-600 focus:ring-indigo-500">
      <label class="text-sm text-neutral-700 dark:text-neutral-300">Activo</label>
    </div>
  </div>

  <div class="pt-2 flex justify-end gap-2">
    <a href="{{ route('productos.index') }}"
       class="rounded-lg border border-neutral-400 dark:border-neutral-600 text-neutral-700 dark:text-neutral-300 px-4 py-2 hover:bg-neutral-100 dark:hover:bg-neutral-800 transition">
       Cancelar
    </a>
    <button
      type="submit"
      class="rounded-lg bg-indigo-600 text-white px-4 py-2 hover:bg-indigo-700 transition">
      {{ $submitText }}
    </button>
  </div>
</form>
