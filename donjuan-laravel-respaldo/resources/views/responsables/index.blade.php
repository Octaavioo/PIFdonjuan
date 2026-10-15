@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Responsables</h1>
        <p class="page-description">Personas responsables de las operaciones de inventario.</p>
    </div>

    <a href="{{ route('responsables.create') }}" class="btn btn-primary">
        + Nuevo responsable
    </a>
</div>

<div class="card table-card">
    <div style="padding:22px 22px 0;">
        <h2 class="section-title">Listado de responsables</h2>
        <p class="page-description">{{ $responsables->total() }} registros</p>
    </div>

    <div class="table-wrapper">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>RUT</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
            @forelse($responsables as $responsable)
                <tr>
                    <td>{{ $responsable->nombre }}</td>
                    <td>{{ $responsable->rut ?? '-' }}</td>
                    <td>{{ $responsable->rol ?? '-' }}</td>
                    <td>
                        <div style="display:flex;gap:8px;">
                            <a href="{{ route('responsables.show', $responsable) }}" class="btn btn-secondary btn-sm">Ver</a>
                            <a href="{{ route('responsables.edit', $responsable) }}" class="btn btn-secondary btn-sm">Editar</a>

                            <form method="POST" action="{{ route('responsables.destroy', $responsable) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Eliminar este responsable?')">
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
                            <div class="empty-state-icon">♟</div>
                            <strong>No hay responsables registrados.</strong>
                            <span>Comienza agregando el primer responsable del inventario.</span>
                            <div style="margin-top:18px;">
                                <a href="{{ route('responsables.create') }}" class="btn btn-primary">
                                    + Nuevo responsable
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

@if($responsables->hasPages())
    <div style="margin-top:18px;">
        {{ $responsables->links() }}
    </div>
@endif
@endsection
