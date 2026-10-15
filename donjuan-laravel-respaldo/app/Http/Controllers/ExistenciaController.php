<?php
namespace App\Http\Controllers;
use App\Models\{Stock,Bodega,Producto};
class ExistenciaController extends Controller
{
 public function index(){ $stocks=Stock::with(['producto','bodega'])->orderBy('bodega_id')->get(); return view('existencias.index',compact('stocks')); }
}
