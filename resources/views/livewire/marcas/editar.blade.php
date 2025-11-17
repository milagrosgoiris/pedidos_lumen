<div class="p-6 space-y-6">
  <h1 class="text-xl font-semibold">Editar marca</h1>

  @include('livewire.marcas._form', [
      'submitAction' => 'update',
      'submitLabel'  => 'Actualizar',
      'proveedores'  => $proveedores,
  ])
</div>

