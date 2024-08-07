@extends('layout')

@section('content')
    <h1>Crear Nueva Máquina</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> Hubo algunos problemas con su entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('maquinas.store') }}" method="POST">
        @csrf

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}">
        </div>
        <div>
            <label for="fecha_compra">Fecha de Compra:</label>
            <input type="date" name="fecha_compra" value="{{ old('fecha_compra') }}">
        </div>
        <div>
            <label for="vida_util_anios">Vida Útil (Años):</label>
            <input type="number" name="vida_util_anios" value="{{ old('vida_util_anios') }}">
        </div>
        <div>
            <label for="costo">Costo:</label>
            <input type="number" step="0.01" name="costo" value="{{ old('costo') }}">
        </div>
        <div>
            <label for="intervalo_servicio_horas">Intervalo de Servicio (Horas):</label>
            <input type="number" name="intervalo_servicio_horas" value="{{ old('intervalo_servicio_horas') }}">
        </div>
        <div>
            <label for="costo_servicio">Costo de Servicio:</label>
            <input type="number" step="0.01" name="costo_servicio" value="{{ old('costo_servicio') }}">
        </div>
        <button type="submit">Crear</button>
    </form>
@endsection