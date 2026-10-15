<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Bodega;
use App\Models\Responsable;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class MovimientoController extends Controller
{
    public function index(): View
    {
        $movimientos = Movimiento::with([
            'producto',
            'bodegaOrigen',
            'bodegaDestino',
            'responsable',
        ])->latest('fecha')->paginate(15);

        return view('movimientos.index', compact('movimientos'));
    }

    public function create(): View
    {
        return view('movimientos.create', [
            'productos' => Producto::where('estado', 'Disponible')->orderBy('nombre')->get(),
            'bodegas' => Bodega::orderBy('nombre')->get(),
            'responsables' => Responsable::orderBy('nombre')->get(),
        ]);
    }

    public function store(\Illuminate\Http\Request $request): RedirectResponse
    {
        $data = $request->validate([
            'tipo' => ['required', 'in:Entrada,Salida,Traslado'],
            'producto_id' => ['required', 'exists:productos,id'],
            'bodega_origen_id' => ['nullable', 'exists:bodegas,id'],
            'bodega_destino_id' => ['nullable', 'exists:bodegas,id'],
            'cantidad' => ['required', 'integer', 'min:1'],
            'responsable_id' => ['required', 'exists:responsables,id'],
            'observaciones' => ['nullable', 'string', 'max:1000'],
        ]);

        if ($data['tipo'] === 'Entrada' && empty($data['bodega_destino_id'])) {
            return back()
                ->withErrors(['bodega_destino_id' => 'La entrada requiere una bodega de destino.'])
                ->withInput();
        }

        if ($data['tipo'] === 'Salida' && empty($data['bodega_origen_id'])) {
            return back()
                ->withErrors(['bodega_origen_id' => 'La salida requiere una bodega de origen.'])
                ->withInput();
        }

        if ($data['tipo'] === 'Traslado') {
            if (empty($data['bodega_origen_id']) || empty($data['bodega_destino_id'])) {
                return back()
                    ->withErrors(['bodega_origen_id' => 'El traslado requiere una bodega de origen y una de destino.'])
                    ->withInput();
            }

            if ($data['bodega_origen_id'] === $data['bodega_destino_id']) {
                return back()
                    ->withErrors(['bodega_destino_id' => 'La bodega de origen y destino deben ser diferentes.'])
                    ->withInput();
            }
        }

        DB::transaction(function () use ($data) {
            $quantity = (int) $data['cantidad'];
            $productId = $data['producto_id'];

            if (in_array($data['tipo'], ['Salida', 'Traslado'], true)) {
                $originId = $data['bodega_origen_id'];

                $stock = Stock::where('producto_id', $productId)
                    ->where('bodega_id', $originId)
                    ->lockForUpdate()
                    ->first();

                if (!$stock || $stock->cantidad < $quantity) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'cantidad' => 'No hay stock suficiente en la bodega de origen.',
                    ]);
                }

                $stock->decrement('cantidad', $quantity);
            }

            if (in_array($data['tipo'], ['Entrada', 'Traslado'], true)) {
                $destinationId = $data['bodega_destino_id'];

                $stock = Stock::firstOrCreate(
                    [
                        'producto_id' => $productId,
                        'bodega_id' => $destinationId,
                    ],
                    ['cantidad' => 0]
                );

                $stock->increment('cantidad', $quantity);
            }

            Movimiento::create([
                ...$data,
                'fecha' => now(),
            ]);
        });

        return redirect()
            ->route('movimientos.index')
            ->with('success', 'Movimiento registrado correctamente.');
    }

    public function historial(): View
    {
        $movimientos = Movimiento::with([
            'producto',
            'bodegaOrigen',
            'bodegaDestino',
            'responsable',
        ])->latest('fecha')->paginate(25);

        return view('movimientos.historial', compact('movimientos'));
    }
}
