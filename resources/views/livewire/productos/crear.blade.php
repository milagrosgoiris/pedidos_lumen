<div class="p-6 space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-xl font-semibold">Nuevo producto</h1>
    <a href="{{ route('productos.index') }}" class="text-sm text-neutral-600 hover:underline">← Volver</a>
  </div>

  <div class="bg-white dark:bg-neutral-900 rounded-xl shadow p-4">
    @include('livewire.productos._form', [
      'action' => 'save',
      'submitText' => 'Guardar'
    ])
  </div>
</div>
