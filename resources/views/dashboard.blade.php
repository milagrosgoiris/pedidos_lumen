<x-layouts.app :title="__('Dashboard')">
  <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    <a class="bg-white p-4 rounded-xl shadow hover:shadow-md" href="{{ route('productos.index') }}">Productos</a>
    <a class="bg-white p-4 rounded-xl shadow hover:shadow-md" href="{{ route('proveedores.index') }}">Proveedores</a>
    <a class="bg-white p-4 rounded-xl shadow hover:shadow-md" href="{{ route('locales.index') }}">Locales</a>
    <a class="bg-white p-4 rounded-xl shadow hover:shadow-md" href="{{ route('pedidos.index') }}">Pedidos</a>
    <a class="bg-white p-4 rounded-xl shadow hover:shadow-md" href="{{ route('pedidos.crear') }}">Nuevo Pedido</a>
  </div>

  <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
      <div class="grid auto-rows-min gap-4 md:grid-cols-3">
          <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
              <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
          </div>
          <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
              <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
          </div>
          <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
              <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
          </div>
      </div>
      <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
          <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
      </div>
  </div>
</x-layouts.app>
