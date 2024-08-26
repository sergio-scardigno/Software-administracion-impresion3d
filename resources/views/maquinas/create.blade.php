@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Máquina</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
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

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
        </div>

        <div class="mb-3">
            <label for="fecha_compra" class="form-label">Fecha de Compra:</label>
            <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" value="{{ old('fecha_compra') }}">
        </div>

        <div class="mb-3">
            <label for="vida_util_anios" class="form-label">Vida Útil (Años):</label>
            <input type="number" class="form-control" id="vida_util_anios" name="vida_util_anios" value="{{ old('vida_util_anios') }}">
        </div>

        <div class="mb-3">
            <label for="costo" class="form-label">Costo en UDS:</label>
            <input type="number" step="0.01" class="form-control" id="costo" name="costo" value="{{ old('costo') }}">
        </div>

        <div class="mb-3">
            <label for="wats_consumidas_por_hora" class="form-label">Consumo de Energia por hora en watts:</label>
            <input type="number" step="0.01" class="form-control" id="wats_consumidas_por_hora" name="wats_consumidas_por_hora" value="{{ old('wats_consumidas_por_hora') }}">
        </div>

        <div class="mb-3">
            <label for="intervalo_servicio_horas" class="form-label">Intervalo de Servicio (Horas):</label>
            <input type="number" class="form-control" id="intervalo_servicio_horas" name="intervalo_servicio_horas" value="{{ old('intervalo_servicio_horas') }}">
        </div>
        

        <div class="mb-3">
            <label for="costo_servicio" class="form-label">Costo de Servicio en UDS:</label>
            <input type="number" step="0.01" class="form-control" id="costo_servicio" name="costo_servicio" value="{{ old('costo_servicio') }}">
        </div>

        <div class="mb-3">
            <label for="costo_mantenimiento_por_hora" class="form-label">Costo de Mantenimiento por hora en UDS:</label>
            <input type="number" step="0.01" class="form-control" id="costo_mantenimiento_por_hora" name="costo_mantenimiento_por_hora" value="{{ old('costo_mantenimiento_por_hora') }}">
        </div>

        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
<p>*Intervalo de Servicio, cantidad de horas que tiene que pasar para realizar un mantenimiento.</p>

@endsection