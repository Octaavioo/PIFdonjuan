<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(): View
    {
        $productos = Producto::latest()->paginate(15);

        return view('productos.index', compact('productos'));
    }

    public function create(): View
    {
        return view('productos.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'tipo' => ['nullable', 'string', 'max:30'],
            'formato' => ['nullable', 'string', 'max:30'],
            'peso' => ['nullable', 'string', 'max:50'],
            'vencimiento' => ['nullable', 'date'],
            'estado' => ['required', 'string', 'max:30'],
        ]);

        Producto::create($datos);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    public function show(Producto $producto): View
    {
        $producto->load('stocks.bodega');

        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto): View
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto): RedirectResponse
    {
        $datos = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'tipo' => ['nullable', 'string', 'max:30'],
            'formato' => ['nullable', 'string', 'max:30'],
            'peso' => ['nullable', 'string', 'max:50'],
            'vencimiento' => ['nullable', 'date'],
            'estado' => ['required', 'string', 'max:30'],
        ]);

        $producto->update($datos);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto): RedirectResponse
    {
        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}
