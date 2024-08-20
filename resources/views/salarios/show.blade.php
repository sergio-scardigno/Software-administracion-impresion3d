@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Ver Salario</h1>

    <div class="mb-3">
        <strong>Tipo Trabajador:</strong>
        <p class="form-control-plaintext">{{ $salario->tipo_trabajador }}</p>
    </div>

    <div class="mb-3">
        <strong>Salario Mensual:</strong>
        <p class="form-control-plaintext">{{ $salario->salario_mensual }}</p>
    </div>

    <a href="{{ route('salarios.index') }}" class="btn btn-secondary">Volver</a>
</div>

@endsection