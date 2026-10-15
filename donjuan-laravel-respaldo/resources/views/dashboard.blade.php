@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Hola, {{ auth()->user()->name ?? 'Administrador' }} 👋</h1>
        <p class="page-description">Bienvenido al sistema de gestión de inventario. Aquí tienes un resumen de la información actual.</p>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card stat-card">
        <div class="stat-icon blue">📦</div>
        <div><div class="stat-label">Productos</div><div class="stat-value">{{ $productos }}</div><div class="stat-note">Productos registrados</div></div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon green">🏠</div>
        <div><div class="stat-label">Bodegas</div><div class="stat-value">{{ $bodegas }}</div><div class="stat-note">Bodegas registradas</div></div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon purple">👥</div>
        <div><div class="stat-label">Responsables</div><div class="stat-value">{{ $responsables }}</div><div class="stat-note">Responsables registrados</div></div>
    </div>
    <div class="card stat-card">
        <div class="stat-icon gold">📊</div>
        <div><div class="stat-label">Unidades en stock</div><div class="stat-value">{{ $unidadesStock }}</div><div class="stat-note">Total de unidades</div></div>
    </div>
</div>

<div class="dashboard-columns">
    <section class="card">
        <div class="section-head">
            <div>
                <h2 class="section-title">Últimos movimientos</h2>
                <p class="section-description">Aquí se muestran los movimientos más recientes del inventario.</p>
            </div>
            <a href="{{ route('movimientos.historial') }}" class="btn btn-secondary">Ver todo →</a>
        </div>

        @if($ultimosMovimientos->count())
            <div class="table-wrapper">
                <table class="data-table">
                    <thead><tr><th>Tipo</th><th>Producto</th><th>Cantidad</th><th>Fecha</th></tr></thead>
                    <tbody>
                    @foreach($ultimosMovimientos as $movimiento)
                        <tr>
                            <td>{{ $movimiento->tipo }}</td>
                            <td>{{ $movimiento->producto->nombre ?? '-' }}</td>
                            <td>{{ $movimiento->cantidad }}</td>
                            <td>{{ $movimiento->fecha?->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">▤</div>
                <strong>Todavía no existen movimientos.</strong>
                <span>Los movimientos de inventario aparecerán aquí cuando se registren.</span>
                <div style="margin-top:18px;">
                    <a href="{{ route('movimientos.create') }}" class="btn btn-primary">＋ Registrar movimiento</a>
                </div>
            </div>
        @endif
    </section>

    <section class="card">
        <div class="section-head">
            <div>
                <h2 class="section-title">Acciones rápidas</h2>
                <p class="section-description">Accede rápidamente a las funciones principales del sistema.</p>
            </div>
        </div>

        <div class="quick-grid">
            <a class="quick-card" href="{{ route('productos.index') }}">
                <div class="stat-icon blue">📦</div>
                <div class="quick-title">Gestionar productos →</div>
                <div class="quick-description">Registrar, editar y ver productos.</div>
            </a>
            <a class="quick-card" href="{{ route('bodegas.index') }}">
                <div class="stat-icon green">🏠</div>
                <div class="quick-title">Gestionar bodegas →</div>
                <div class="quick-description">Administrar bodegas de almacenamiento.</div>
            </a>
            <a class="quick-card" href="{{ route('responsables.index') }}">
                <div class="stat-icon purple">👥</div>
                <div class="quick-title">Gestionar responsables →</div>
                <div class="quick-description">Administrar responsables de inventario.</div>
            </a>
            <a class="quick-card" href="{{ route('movimientos.create') }}">
                <div class="stat-icon gold">⇄</div>
                <div class="quick-title">Registrar movimiento →</div>
                <div class="quick-description">Ingresos, salidas y traslados.</div>
            </a>
        </div>
    </section>
</div>
@endsection
