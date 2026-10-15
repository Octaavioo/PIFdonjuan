@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Productos</h1>
        <p class="page-description">Administra los productos registrados en el inventario.</p>
    </div>
    <a href="{{ route('productos.create') }}" class="btn btn-primary">＋ Nuevo producto</a>
</div>

<div class="card table-card">
    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nombre</th><th>Tipo</th><th>Formato</th><th>Estado</th><th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @forelse($productos as $producto)
                <tr>
                    <td><strong>{{ $producto->nombre }}</strong></td>
                    <td>{{ $producto->tipo ?? '-' }}</td>
                    <td>{{ $producto->formato ?? '-' }}</td>
                    <td>
                        <span class="badge {{ $producto->estado === 'Disponible' ? 'badge-success' : 'badge-warning' }}">
                            {{ $producto->estado }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex;gap:7px;flex-wrap:wrap;">
                            <a href="{{ route('productos.show', $producto) }}" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="{{ route('productos.edit', $producto) }}" class="btn btn-secondary btn-sm">Editar</a>
                            <form method="POST" action="{{ route('productos.destroy', $producto) }}">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <div class="empty-state-icon">📦</div>
                            <strong>No hay productos registrados</strong>
                            <span>Comienza agregando el primer producto al inventario.</span>
                            <div style="margin-top:18px;">
                                <a href="{{ route('productos.create') }}" class="btn btn-primary">＋ Nuevo producto</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($productos->hasPages())
    <div class="pagination">{{ $productos->links() }}</div>
@endif
@endsection
