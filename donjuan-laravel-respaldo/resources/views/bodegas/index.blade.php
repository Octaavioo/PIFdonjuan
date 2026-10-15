@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Bodegas</h1>
        <p class="page-description">Administra los lugares donde se almacena el inventario.</p>
    </div>

    <a href="{{ route('bodegas.create') }}" class="btn btn-primary">
        + Nueva bodega
    </a>
</div>

<div class="card table-card">
    <div style="padding:22px 22px 0;">
        <h2 class="section-title">Listado de bodegas</h2>
        <p class="page-description">{{ $bodegas->total() }} registros</p>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
            @forelse($bodegas as $bodega)
                <tr>
                    <td>{{ $bodega->nombre }}</td>
                    <td>{{ $bodega->ubicacion ?? '-' }}</td>
                    <td>{{ $bodega->descripcion ?? '-' }}</td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('bodegas.show', $bodega) }}" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="{{ route('bodegas.edit', $bodega) }}" class="btn btn-secondary btn-sm">Editar</a>

                            <form method="POST" action="{{ route('bodegas.destroy', $bodega) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar esta bodega?')">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-state-icon">🏠</div>
                            <strong>No hay bodegas registradas.</strong>
                            <span>Comienza agregando la primera bodega del inventario.</span>
                            <div style="margin-top:18px;">
                                <a href="{{ route('bodegas.create') }}" class="btn btn-primary">
                                    + Nueva bodega
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

@if($bodegas->hasPages())
    <div style="margin-top:18px;">
        {{ $bodegas->links() }}
    </div>
@endif
@endsection
