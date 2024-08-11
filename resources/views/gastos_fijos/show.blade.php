@extends('layout')

@section('content')
    <div class="container">
        <h1>Detalle del Gasto Fijo</h1>

        @if($gastoFijo)
        <div class="mb-3">
            <label for="tipo_gasto" class="form-label">Tipo de Gasto</label>
            <p>{{ $gastoFijo->tipo_gasto }}</p>
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <p>{{ $gastoFijo->monto }}</p>
        </div>
    @else
        <p>No se encontró el gasto fijo.</p>
    @endif

        <a href="{{ route('gastos_fijos.index') }}" class="btn btn-secondary">Volver</a>
    </div>
@endsection
