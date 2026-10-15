@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Movimientos</h1>
        <p class="page-description">Registra entradas, salidas y traslados de inventario.</p>
    </div>

    <a href="{{ route('movimientos.create') }}" class="btn btn-primary">
        + Registrar movimiento
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul style="margin:0;padding-left:18px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                </tr>
            @empty
                <tr>
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-state-icon">▤</div>
                            <strong>No hay movimientos registrados.</strong>
                            <span>Los movimientos aparecerán aquí cuando se registren.</span>
                            <div style="margin-top:18px;">
                                <a href="{{ route('movimientos.create') }}" class="btn btn-primary">
                                    + Registrar movimiento
                                </a>
                            </div>
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
