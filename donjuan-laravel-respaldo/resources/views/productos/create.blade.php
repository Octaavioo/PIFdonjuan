@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-6">Nuevo producto</h1>

<form method="POST" action="{{ route('productos.store') }}"
      class="bg-white p-6 rounded shadow max-w-2xl">
    @csrf

    <div class="mb-4">
        <label class="block mb-1">Nombre</label>
        <input name="nombre" value="{{ old('nombre') }}"
               required class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Tipo</label>
        <input name="tipo" value="{{ old('tipo') }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Formato</label>
        <input name="formato" value="{{ old('formato') }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Peso</label>
        <input name="peso" value="{{ old('peso') }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-4">
        <label class="block mb-1">Vencimiento</label>
        <input type="date" name="vencimiento"
               value="{{ old('vencimiento') }}"
               class="w-full border rounded p-2">
    </div>

    <div class="mb-6">
        <label class="block mb-1">Estado</label>
        <select name="estado" class="w-full border rounded p-2">
            <option value="Disponible">Disponible</option>
            <option value="Agotado">Agotado</option>
            <option value="Inactivo">Inactivo</option>
        </select>
    </div>

    <button class="bg-blue-600 text-white px-5 py-2 rounded">
        Guardar producto
    </button>
</form>
@endsection
