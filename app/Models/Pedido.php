<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    // La tabla por convención es "pedidos", no hace falta $table.
    // Esta tabla SÍ tiene timestamps (created_at/updated_at), así que no pongas $timestamps=false.
    protected $fillable = [
        'tipo','origen_local_id','destino_local_id','proveedor_id',
        'estado','total_estimado','creado_por'
    ];

    // --- Relaciones ---
    public function items()      { return $this->hasMany(PedidoItem::class); }
    public function archivos()   { return $this->hasMany(Archivo::class); }
    public function comentarios(){ return $this->hasMany(PedidoComentario::class); }
    public function proveedor()  { return $this->belongsTo(Proveedor::class); }
    public function origen()     { return $this->belongsTo(Local::class, 'origen_local_id'); }
    public function destino()    { return $this->belongsTo(Local::class, 'destino_local_id'); }
public function historial()
{
    return $this->hasMany(\App\Models\HistorialEstado::class, 'entidad_id')
        ->where('entidad','pedido')
        ->latest();
}

/** Estados válidos */
public static function labels(): array
{
    return [
        0=>'Borrador', 1=>'Solicitado', 2=>'Aprobado', 3=>'Preparado',
        4=>'Enviado', 5=>'Recibido', 9=>'Cancelado',
    ];
}

/** Transiciones permitidas sencillas */
public static function transitions(): array
{
    return [
        0 => [1,9],
        1 => [2,4,9],
        2 => [3,4,9],
        3 => [4,9],
        4 => [5,9],
        5 => [],
        9 => [],
    ];
}

public $timestamps = false;


}
