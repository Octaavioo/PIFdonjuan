<?php
namespace App\Http\Controllers;
use App\Models\Bodega;
use Illuminate\Http\Request;
class BodegaController extends Controller
{
 public function index(){return view('bodegas.index',['bodegas'=>Bodega::latest()->paginate(10)]);}
 public function create(){return view('bodegas.create');}
 public function store(Request $r){$data=$r->validate(['nombre'=>'required|string|max:120','ubicacion'=>'nullable|string|max:200','descripcion'=>'nullable|string|max:255']);Bodega::create($data);return redirect()->route('bodegas.index')->with('success','Bodega creada correctamente.');}
 public function show(Bodega $bodega){return view('bodegas.show',compact('bodega'));}
 public function edit(Bodega $bodega){return view('bodegas.edit',compact('bodega'));}
 public function update(Request $r,Bodega $bodega){$data=$r->validate(['nombre'=>'required|string|max:120','ubicacion'=>'nullable|string|max:200','descripcion'=>'nullable|string|max:255']);$bodega->update($data);return redirect()->route('bodegas.index')->with('success','Bodega actualizada correctamente.');}
 public function destroy(Bodega $bodega){try{$bodega->delete();return back()->with('success','Bodega eliminada correctamente.');}catch(\Throwable $e){return back()->withErrors('No se puede eliminar la bodega porque tiene registros asociados.');}}
}
