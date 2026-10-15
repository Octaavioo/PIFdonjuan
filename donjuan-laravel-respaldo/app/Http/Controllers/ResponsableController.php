<?php
namespace App\Http\Controllers;
use App\Models\Responsable;
use Illuminate\Http\Request;
class ResponsableController extends Controller
{
 public function index(){return view('responsables.index',['responsables'=>Responsable::latest()->paginate(10)]);}
 public function create(){return view('responsables.create');}
 public function store(Request $r){$data=$r->validate(['nombre'=>'required|string|max:150','rut'=>'nullable|string|max:20|unique:responsables,rut','rol'=>'required|string|max:30']);Responsable::create($data);return redirect()->route('responsables.index')->with('success','Responsable creado correctamente.');}
 public function show(Responsable $responsable){return view('responsables.show',compact('responsable'));}
 public function edit(Responsable $responsable){return view('responsables.edit',compact('responsable'));}
 public function update(Request $r,Responsable $responsable){$data=$r->validate(['nombre'=>'required|string|max:150','rut'=>'nullable|string|max:20|unique:responsables,rut,'.$responsable->id,'rol'=>'required|string|max:30']);$responsable->update($data);return redirect()->route('responsables.index')->with('success','Responsable actualizado correctamente.');}
 public function destroy(Responsable $responsable){try{$responsable->delete();return back()->with('success','Responsable eliminado correctamente.');}catch(\Throwable $e){return back()->withErrors('No se puede eliminar porque el responsable tiene movimientos asociados.');}}
}
