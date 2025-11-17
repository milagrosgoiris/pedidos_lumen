<?php

namespace App\Livewire\Productos;

use App\Models\Producto;
use App\Models\Marca;
use Livewire\Component;

class Crear extends Component
{
    // Propiedades del formulario
    public string $nombre = '';
    public ?int $marca_id = null;
    public string $unidad_base = '';
    public bool $activo = true;

    // Reglas de validación
    protected function rules(): array
    {
        return [
            'nombre'       => ['required', 'string', 'max:150'],
            'marca_id'     => ['nullable', 'exists:marcas,id'],
            'unidad_base'  => ['required', 'string', 'max:30'],
            'activo'       => ['boolean'],
        ];
    }

    // Guardar el nuevo producto
    public function save()
    {
        $this->validate();

        Producto::create([
            'nombre'       => trim($this->nombre),
            'marca_id'     => $this->marca_id,
            'unidad_base'  => $this->unidad_base,
            'activo'       => $this->activo,
        ]);

        session()->flash('ok', 'Producto creado correctamente.');
        return redirect()->route('productos.index');
    }

    // Renderizar vista
    public function render()
    {
        return view('livewire.productos.crear', [
            'marcas' => Marca::orderBy('nombre')->get(),
        ])->layout('layouts.app', ['title' => 'Nuevo producto | Pedidos Lumen']);
    }
}
