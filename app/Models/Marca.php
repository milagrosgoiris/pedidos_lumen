<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas';

    protected $fillable = [
        'nombre',
        'proveedor_id',
    ];

    public $timestamps = false; // o true si tu tabla tiene created_at/updated_at

    /** Una marca pertenece a un proveedor */
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    /** Productos de esta marca */
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    /** (opcional) scope de activas */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }
}
