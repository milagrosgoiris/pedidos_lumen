<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    // 👇 forzamos el nombre correcto de la tabla
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'activo',
    ];

    // Relación con marca (si ya creaste la pivote marca_proveedor)

    public function marcas()
{
    return $this->hasMany(Marca::class);
}
public $timestamps = false;
}
