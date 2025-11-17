<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model {
  public $timestamps = false;
  protected $fillable = ['nombre','marca_id','unidad_base','sku','activo'];
  public function marca(){ return $this->belongsTo(Marca::class); }

}
