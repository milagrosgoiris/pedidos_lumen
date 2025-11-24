<div class="min-h-screen bg-[#0b0b0f] text-neutral-200 p-8 space-y-6">

  <h1 class="text-2xl font-semibold mb-4">Nuevo Pedido</h1>

  {{-- Sección principal --}}
  <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6 space-y-6">

    {{-- Datos principales --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      {{-- Tipo --}}
      <div>
        <label class="block text-sm text-neutral-400 mb-1">Tipo</label>
        <select wire:model="tipo"
          class="w-full rounded-lg bg-neutral-800 border border-neutral-700 text-neutral-200 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="1">A proveedor</option>
          <option value="2">Entre locales</option>
        </select>
      </div>

      {{-- Destino --}}
      <div>
        <label class="block text-sm text-neutral-400 mb-1">Destino</label>
        <select wire:model="destino_local_id"
          class="w-full rounded-lg bg-neutral-800 border border-neutral-700 text-neutral-200 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">-- seleccionar --</option>
          @foreach($locales as $local)
            <option value="{{ $local->id }}">{{ $local->nombre }}</option>
          @endforeach
        </select>
      </div>

      {{-- Proveedor --}}
      <div>
        <label class="block text-sm text-neutral-400 mb-1">Proveedor</label>
        <select wire:model="proveedor_id"
          class="w-full rounded-lg bg-neutral-800 border border-neutral-700 text-neutral-200 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">-- seleccionar --</option>
          @foreach($proveedores as $prov)
            <option value="{{ $prov->id }}">{{ $prov->nombre }}</option>
          @endforeach
        </select>
      </div>

      {{-- Origen (si es entre locales) --}}
      <div>
        <label class="block text-sm text-neutral-400 mb-1">Origen (si es entre locales)</label>
        <select wire:model="origen_local_id"
          class="w-full rounded-lg bg-neutral-800 border border-neutral-700 text-neutral-200 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">-- seleccionar --</option>
          @foreach($locales as $local)
            <option value="{{ $local->id }}">{{ $local->nombre }}</option>
          @endforeach
        </select>
      </div>
    </div>
  </div>

  {{-- Ítems --}}
  <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6">
    <div class="flex items-center justify-between mb-3">
      <h2 class="font-medium text-neutral-200">Ítems</h2>
      <button wire:click="addItem" type="button"
        class="rounded-lg bg-indigo-600 text-white px-3 py-1 text-sm hover:bg-indigo-700">
        + Agregar ítem
      </button>
    </div>

    {{-- Tabla de ítems --}}
    <table class="w-full text-sm border-collapse">
      <thead class="text-neutral-400 border-b border-neutral-800">
        <tr>
          <th class="text-left py-2 px-2">Producto</th>
          <th class="text-left py-2 px-2">Cantidad</th>
          <th></th>
        </tr>
      </thead>

      <tbody class="divide-y divide-neutral-800">
        @foreach($items as $i => $item)
          <tr class="hover:bg-neutral-800/50">
            {{-- PRODUCTO AGRUPADO POR MARCA --}}
            <td class="py-2 px-2">
              <select wire:model="items.{{ $i }}.producto_id"
                class="w-full bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-lg px-2 py-1 focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- seleccionar --</option>
                @foreach($marcas as $marca)
                  @if($marca->productos->count() > 0)
                    <optgroup label="{{ $marca->nombre }}" class="bg-neutral-900 text-neutral-400">
                      @foreach($marca->productos as $prod)
                        <option value="{{ $prod->id }}">
                          {{ $marca->nombre }} — {{ $prod->nombre }}
                        </option>
                      @endforeach
                    </optgroup>
                  @endif
                @endforeach
              </select>


            {{-- CANTIDAD --}}
            <td class="py-2 px-2">
              <input type="number" wire:model="items.{{ $i }}.cantidad"
                class="w-20 bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-lg px-2 py-1"
                min="1" step="1">
            </td>

            {{-- BOTÓN QUITAR --}}
            <td class="py-2 px-2 text-right">
              <button type="button" wire:click="removeItem({{ $i }})"
                class="text-rose-500 text-sm hover:underline">Quitar</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- Botón Guardar --}}
  <div class="text-right">
    <button wire:click="save"
      class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
      Guardar pedido
    </button>
  </div>
</div>
