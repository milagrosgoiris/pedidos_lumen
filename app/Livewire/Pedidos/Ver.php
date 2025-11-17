<?php

namespace App\Livewire\Pedidos;

use App\Models\Archivo;
use App\Models\HistorialEstado;
use App\Models\Pedido;
use App\Models\PedidoComentario;
use Livewire\Component;
use Livewire\WithFileUploads;

class Ver extends Component
{
    use WithFileUploads;

    public Pedido $pedido;

    // Comentarios
    public string $comentario = '';

    // Archivos
    public $archivo; // UploadedFile|null
    public ?string $archivo_titulo = null;

    // Cambio de estado
    public string $nota_estado = '';

    public function mount(Pedido $pedido): void
    {
        $this->pedido = $pedido->load([
            'items.producto:id,nombre,unidad_base',
            'proveedor:id,nombre',
            'origen:id,nombre',
            'destino:id,nombre',
            'comentarios.user:id,name',
            'archivos',
            'historial.user:id,name',
        ]);
    }

    public function addComentario(): void
    {
        $this->validate([
            'comentario' => 'required|string|max:500',
        ]);

        PedidoComentario::create([
            'pedido_id' => $this->pedido->id,
            'user_id'    => auth()->id(),
            'contenido'  => $this->comentario,
        ]);

        $this->comentario = '';
        $this->pedido->refresh()->load('comentarios.user');
    }

    public function uploadArchivo(): void
    {
        $this->validate([
            'archivo'        => 'required|file|max:5120', // 5MB
            'archivo_titulo' => 'nullable|string|max:120',
        ]);

        $path = $this->archivo->store("public/pedidos/{$this->pedido->id}");
        $url  = \Storage::url($path);

        Archivo::create([
            'entidad'    => 'pedido',
            'entidad_id' => $this->pedido->id,
            'path'       => $url,
            'tipo'       => $this->archivo->getClientMimeType(),
            'titulo'     => $this->archivo_titulo,
        ]);

        $this->reset(['archivo', 'archivo_titulo']);
        session()->flash('ok', 'Archivo subido.');
        $this->pedido->refresh()->load('archivos');
    }

    public function cambiarEstado(int $nuevo): void
    {
        $actual  = (int) $this->pedido->estado;
        $allowed = \App\Models\Pedido::transitions()[$actual] ?? [];

        if (! in_array($nuevo, $allowed, true)) {
            // opcional: mensaje
            return;
        }

        $this->pedido->update(['estado' => $nuevo]);

        HistorialEstado::create([
            'entidad'    => 'pedido',
            'entidad_id' => $this->pedido->id,
            'estado'     => $nuevo,
            'user_id'    => auth()->id(),
            'nota'       => $this->nota_estado ?: null,
        ]);

        $this->nota_estado = '';
        $this->pedido->refresh()->load('historial.user');
    }

    public function render()
    {
        // Evitamos ->title() para que Intelephense no marque error
        return view('livewire.pedidos.ver')
            ->layout('layouts.app', ['title' => "Pedido #{$this->pedido->id}"]);
    }
}
