<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\BodegaController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ExistenciaController;

Route::get('/', fn () => redirect()->route('dashboard'));

Route::get('/dashboard', function () {
    return view('dashboard', [
        'productos' => \App\Models\Producto::count(),
        'bodegas' => \App\Models\Bodega::count(),
        'responsables' => \App\Models\Responsable::count(),
        'unidades' => \App\Models\Stock::sum('cantidad'),
        'ultimosMovimientos' => \App\Models\Movimiento::with([
            'producto',
            'responsable',
        ])->latest('fecha')->limit(5)->get(),
    ]);
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('productos', ProductoController::class);
    Route::resource('bodegas', BodegaController::class);
    Route::resource('responsables', ResponsableController::class);

    Route::resource('movimientos', MovimientoController::class)
        ->only(['index', 'create', 'store']);

    Route::get('/historial', [MovimientoController::class, 'historial'])
        ->name('movimientos.historial');

    Route::get('/existencias', [ExistenciaController::class, 'index'])
        ->name('existencias');

    Route::get('/diagnostico-productos', function () {
        $productos = \App\Models\Producto::latest()->paginate(15);

        return view('productos.index', compact('productos'));
    });
});

require __DIR__ . '/auth.php';
