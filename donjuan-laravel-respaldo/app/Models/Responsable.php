<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Responsable extends Model
{
    protected $fillable=['nombre','rut','rol'];
    public function movimientos(){return $this->hasMany(Movimiento::class);}
}
