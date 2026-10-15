@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Historial</h1>
        <p class="page-description">Historial completo de los movimientos del inventario.</p>
    </div>

    <a href="{{ route('movimientos.create') }}" class="btn btn-primary">
        + Registrar movimiento
    </a>
</div>

<div class="card table-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Producto</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Cantidad</th>
                    <th>Responsable</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($movimientos as $movimiento)
                <tr>
                    <td>{{ optional($movimiento->fecha)->format('d/m/Y H:i') }}</td>
                    <td>{{ $movimiento->tipo }}</td>
                    <td>{{ $movimiento->producto?->nombre ?? '-' }}</td>
                    <td>{{ $movimiento->bodegaOrigen?->nombre ?? '-' }}</td>
                    <td>{{ $movimiento->bodegaDestino?->nombre ?? '-' }}</td>
                    <td>{{ $movimiento->cantidad }}</td>
                    <td>{{ $movimiento->responsable?->nombre ?? '-' }}</td>
                    <td>{{ $movimiento->observaciones ?: '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">
                        <div class="empty-state">
                            <div class="empty-state-icon">▤</div>
                            <strong>No hay movimientos en el historial.</strong>
                            <span>Cuando registres movimientos, aparecerán aquí.</span>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($movimientos->hasPages())
    <div style="margin-top:18px;">
        {{ $movimientos->links() }}
    </div>
@endif
@endsection
