<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model {
  public $timestamps = false;
  protected $fillable = ['pedido_id','path','titulo','tipo','user_id'];
  public function pedido(){ return $this->belongsTo(Pedido::class); }
}
