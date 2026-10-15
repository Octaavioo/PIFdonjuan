@extends('layouts.app')
@section('content')
<div class="welcome-row"><div><div class="welcome-title">Registrar movimiento</div><div class="welcome-text">Actualiza automáticamente el stock y guarda el historial.</div></div></div>
<form method="POST" action="{{ route('movimientos.store') }}">@csrf
<div class="crud-panel"><div class="form-panel"><div class="form-grid">
<div class="field"><label>Tipo *</label><select name="tipo" id="tipo" required><option value="Entrada">Entrada</option><option value="Salida">Salida</option><option value="Traslado">Traslado</option></select></div>
<div class="field"><label>Producto *</label><select name="producto_id" required><option value="">Seleccionar...</option>@foreach($productos as $p)<option value="{{ $p->id }}" @selected(old('producto_id')==$p->id)>{{ $p->nombre }}</option>@endforeach</select></div>
<div class="field"><label>Bodega origen</label><select name="bodega_origen_id"><option value="">No aplica</option>@foreach($bodegas as $b)<option value="{{ $b->id }}" @selected(old('bodega_origen_id')==$b->id)>{{ $b->nombre }}</option>@endforeach</select></div>
<div class="field"><label>Bodega destino</label><select name="bodega_destino_id"><option value="">No aplica</option>@foreach($bodegas as $b)<option value="{{ $b->id }}" @selected(old('bodega_destino_id')==$b->id)>{{ $b->nombre }}</option>@endforeach</select></div>
<div class="field"><label>Cantidad *</label><input type="number" min="1" name="cantidad" value="{{ old('cantidad',1) }}" required></div>
<div class="field"><label>Responsable *</label><select name="responsable_id" required><option value="">Seleccionar...</option>@foreach($responsables as $r)<option value="{{ $r->id }}">{{ $r->nombre }}</option>@endforeach</select></div>
<div class="field full"><label>Observaciones</label><textarea name="observaciones" placeholder="Detalle opcional del movimiento...">{{ old('observaciones') }}</textarea></div>
</div><div class="form-actions"><button class="btn btn-primary">Registrar movimiento</button><a class="btn" href="{{ route('movimientos.index') }}">Cancelar</a></div></div></div></form>
@endsection
