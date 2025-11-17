<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEstado extends Model
{
    protected $table = 'historial_estados';

    protected $fillable = [
        'entidad', 'entidad_id', 'estado', 'user_id', 'nota',
    ];

    public function user(){ return $this->belongsTo(User::class); }
}
