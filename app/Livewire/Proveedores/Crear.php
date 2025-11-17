<?php

namespace App\Livewire\Proveedores;

use Livewire\Component;
use App\Models\Proveedor;

class Crear extends Component
{
    public string $nombre = '';
    public ?string $cuit = null;
    public ?string $email = null;
    public ?string $telefono = null;
    public bool $activo = true;

    protected function rules(): array
    {
        return [
            'nombre'   => ['required','string','max:150'],
            'cuit'     => ['nullable','string','max:20'],
            'email'    => ['nullable','email','max:150'],
            'telefono' => ['nullable','string','max:50'],
            'activo'   => ['boolean'],
        ];
    }

    public function save()
    {
        $data = $this->validate();
        Proveedor::create($data);

        session()->flash('ok','Proveedor creado.');
        return redirect()->route('proveedores.index');
    }

    public function render()
    {
        return view('livewire.proveedores.crear')
            ->layout('layouts.app', ['title' => 'Nuevo proveedor']);
    }
}
