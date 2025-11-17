<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    protected $table = 'locales';

    protected $fillable = ['nombre', 'direccion', 'activo'];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // 👉 Como la tabla no tiene created_at/updated_at
    public $timestamps = false;
}
