@extends('layout')

@section('content')
    <h1>Editar Máquina</h1>

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

    <form action="{{ route('maquinas.update', $maquina->id_maquina) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" value="{{ $maquina->nombre }}">
        </div>
        <div>
            <label for="fecha_compra">Fecha de Compra:</label>
            <input type="date" name="fecha_compra" value="{{ $maquina->fecha_compra }}">
        </div>
        <div>
            <label for="vida_util_anios">Vida Útil (Años):</label>
            <input type="number" name="vida_util_anios" value="{{ $maquina->vida_util_anios }}">
        </div>
        <div>
            <label for="costo">Costo:</label>
            <input type="number" step="0.01" name="costo" value="{{ $maquina->costo }}">
        </div>
        <div>
            <label for="intervalo_servicio_horas">Intervalo de Servicio (Horas):</label>
            <input type="number" name="intervalo_servicio_horas" value="{{ $maquina->intervalo_servicio_horas }}">
        </div>
        <div>
            <label for="costo_servicio">Costo de Servicio:</label>
            <input type="number" step="0.01" name="costo_servicio" value="{{ $maquina->costo_servicio }}">
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsection
