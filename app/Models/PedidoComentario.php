<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PedidoComentario extends Model {
  public $timestamps = false;
  protected $fillable = ['pedido_id','user_id','texto'];
  public function pedido(){ return $this->belongsTo(Pedido::class); }
}
