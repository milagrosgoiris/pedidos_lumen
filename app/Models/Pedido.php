<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'tipo',
        'origen_local_id',
        'destino_local_id',
        'proveedor_id',
        'estado',
        'total_estimado',
        'creado_por',
    ];

    public $timestamps = true; // ✅ Importante: porque la tabla tiene created_at / updated_at

    // --- Relaciones ---
    public function items()       { return $this->hasMany(PedidoItem::class); }
    public function archivos()    { return $this->hasMany(Archivo::class); }
    public function comentarios() { return $this->hasMany(PedidoComentario::class); }
    public function proveedor()   { return $this->belongsTo(Proveedor::class); }
    public function origen()      { return $this->belongsTo(Local::class, 'origen_local_id'); }
    public function destino()     { return $this->belongsTo(Local::class, 'destino_local_id'); }

    public function historial()
    {
        return $this->hasMany(\App\Models\HistorialEstado::class, 'entidad_id')
            ->where('entidad', 'pedido')
            ->latest();
    }

    /** Estados válidos */
public static function labels(): array
{
    return [
        0 => 'Borrador',
        1 => 'Solicitado',
        2 => 'Preparado',
        3 => 'Recibido',
        9 => 'Cancelado',
    ];
}

public static function transitions(): array
{
    return [
        0 => [1, 9], // de Borrador → Solicitado o Cancelado
        1 => [2, 9], // de Solicitado → En tránsito o Cancelado
        2 => [3, 9], // de En tránsito → Recibido o Cancelado
        3 => [],     // Recibido = final
        9 => [],     // Cancelado = final
    ];
}
}