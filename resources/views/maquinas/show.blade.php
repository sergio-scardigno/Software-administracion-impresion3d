@extends('layout')

@section('content')
    <h1>Detalles de la Máquina</h1>

    <div>
        <strong>Nombre:</strong>
        {{ $maquina->nombre }}
    </div>
    <div>
        <strong>Fecha de Compra:</strong>
        {{ $maquina->fecha_compra }}
    </div>
    <div>
        <strong>Vida Útil (Años):</strong>
        {{ $maquina->vida_util_anios }}
    </div>
    <div>
        <strong>Costo:</strong>
        {{ $maquina->costo }}
    </div>
    <div>
        <strong>Intervalo de Servicio (Horas):</strong>
        {{ $maquina->intervalo_servicio_horas }}
    </div>
    <div>
        <strong>Costo de Servicio:</strong>
        {{ $maquina->costo_servicio }}
    </div>

    <a href="{{ route('maquinas.index') }}">Volver</a>
@endsection
