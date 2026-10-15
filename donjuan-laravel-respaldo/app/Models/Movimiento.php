<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Movimiento extends Model
{
    protected $fillable=['tipo','producto_id','bodega_origen_id','bodega_destino_id','cantidad','responsable_id','observaciones','fecha'];
    protected $casts=['fecha'=>'datetime'];
    public function producto(){return $this->belongsTo(Producto::class);}
    public function bodegaOrigen(){return $this->belongsTo(Bodega::class,'bodega_origen_id');}
    public function bodegaDestino(){return $this->belongsTo(Bodega::class,'bodega_destino_id');}
    public function responsable(){return $this->belongsTo(Responsable::class);}
}
