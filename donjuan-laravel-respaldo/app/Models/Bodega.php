<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Bodega extends Model
{
    protected $fillable=['nombre','ubicacion','descripcion'];
    public function stocks(){return $this->hasMany(Stock::class);}
    public function movimientosOrigen(){return $this->hasMany(Movimiento::class,'bodega_origen_id');}
    public function movimientosDestino(){return $this->hasMany(Movimiento::class,'bodega_destino_id');}
}
