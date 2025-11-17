<div class="p-6 space-y-6">
  <h1 class="text-xl font-semibold">Nueva marca</h1>

  @include('livewire.marcas._form', [
      'submitAction' => 'save',
      'submitLabel'  => 'Crear',
      'proveedores'  => $proveedores,
  ])
</div>
