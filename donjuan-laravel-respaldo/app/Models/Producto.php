<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Producto extends Model
{
    protected $fillable=['nombre','tipo','formato','peso','vencimiento','estado'];
    protected $casts=['vencimiento'=>'date'];
    public function stocks(){return $this->hasMany(Stock::class,'producto_id');}
    public function movimientos(){return $this->hasMany(Movimiento::class,'producto_id');}
}
