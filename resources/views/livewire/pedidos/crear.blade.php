<div class="min-h-screen bg-[#0b0b0f] text-neutral-200 p-8 space-y-6">

  <h1 class="text-2xl font-semibold mb-4">Nuevo Pedido</h1>

  {{-- Sección principal --}}
  <div class="bg-neutral-900 border border-neutral-800 rounded-xl p-6 space-y-6">

    {{-- Datos principales --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
      <div>
        <label class="block text-sm text-neutral-400 mb-1">Tipo</label>
        <select wire:model="tipo"
          class="w-full rounded-lg bg-neutral-800 border border-neutral-700 text-neutral-200 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">A proveedor</option>
          <option value="entre_locales">Entre locales</option>
        </select>
      </div>

      <div>
        <label class="block text-sm text-neutral-400 mb-1">Destino</label>
        <select wire:model="destino_id"
          class="w-full rounded-lg bg-neutral-800 border border-neutral-700 text-neutral-200 px-3 py-2 focus:ring-indigo-500 focus:border-indigo-500">
          <option value="">-- seleccionar --</option>
          @foreach($locales as $local)
            <option value="{{ $local->id }}">{{ $local->nombre }}</option>
          @endforeach
        </select>
      </div>

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

      <div>
        <label class="block text-sm text-neutral-400 mb-1">Origen (si es entre locales)</label>
        <select wire:model="origen_id"
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
      <button wire:click="agregarItem" type="button"
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
          <th class="text-left py-2 px-2">Precio</th>
          <th class="text-left py-2 px-2">Nota</th>
          <th></th>
        </tr>
      </thead>
      <tbody class="divide-y divide-neutral-800">
        @foreach($items as $i => $item)
          <tr class="hover:bg-neutral-800/50">
            <td class="py-2 px-2">
              <select wire:model="items.{{ $i }}.producto_id"
                class="w-full bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-lg px-2 py-1">
                <option value="">-- seleccionar --</option>
                @foreach($productos as $prod)
                  <option value="{{ $prod->id }}">{{ $prod->nombre }}</option>
                @endforeach
              </select>
            </td>

            <td class="py-2 px-2">
              <input type="number" wire:model="items.{{ $i }}.cantidad"
                class="w-20 bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-lg px-2 py-1">
            </td>

            <td class="py-2 px-2">
              <input type="number" wire:model="items.{{ $i }}.precio"
                class="w-24 bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-lg px-2 py-1">
            </td>

            <td class="py-2 px-2">
              <input type="text" wire:model="items.{{ $i }}.nota"
                class="w-full bg-neutral-800 border border-neutral-700 text-neutral-200 rounded-lg px-2 py-1"
                placeholder="opcional">
            </td>

            <td class="py-2 px-2 text-right">
              <button type="button" wire:click="quitarItem({{ $i }})"
                class="text-rose-500 text-sm hover:underline">Quitar</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="flex justify-end text-sm text-neutral-400 mt-4">
      Total estimado:
      <span class="ml-2 text-neutral-100 font-medium">
        {{ number_format($total, 2) }}
      </span>
    </div>
  </div>

  {{-- Botón guardar --}}
  <div class="text-right">
    <button wire:click="guardar" class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700">
      Guardar pedido
    </button>
  </div>
</div>
