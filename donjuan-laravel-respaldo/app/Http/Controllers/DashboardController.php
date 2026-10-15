<?php

namespace App\Http\Controllers;

use App\Models\Bodega;
use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Responsable;
use App\Models\Stock;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'productos' => Producto::count(),
            'bodegas' => Bodega::count(),
            'responsables' => Responsable::count(),
            'unidades' => Stock::sum('cantidad'),
            'movimientos' => Movimiento::count(),
            'ultimosMovimientos' => Movimiento::with([
                'producto',
                'responsable',
                'bodegaOrigen',
                'bodegaDestino',
            ])->latest('fecha')->take(10)->get(),
        ]);
    }
}
