@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalle del Gasto</h1>

    @if($gastoFijo)
        <div class="mb-3">
            <label for="tipo_gasto" class="form-label">Tipo de Gasto:</label>
            <p class="form-control-plaintext">{{ $gastoFijo->tipo_gasto }}</p>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto:</label>
            <p class="form-control-plaintext">{{ $gastoFijo->monto }}</p>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoria:</label>
            <p class="form-control-plaintext">{{ $gastoFijo->categoria }}</p>
        </div>
    @else
        <div class="alert alert-warning">No se encontró el gasto fijo.</div>
    @endif

    <a href="{{ route('gastos_fijos.index') }}" class="btn btn-secondary">Volver</a>
</div>

@endsection
