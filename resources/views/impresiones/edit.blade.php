@extends('layout')

@section('content')
    <h1>Editar Impresión</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('impresiones.update', $impresion->id_impresion) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="id_maquina">Máquina:</label>
            <input type="number" id="id_maquina" name="id_maquina" value="{{ old('id_maquina', $impresion->id_maquina) }}" required>
        </div>
        <div>
            <label for="id_trabajador">Trabajador:</label>
            <input type="number" id="id_trabajador" name="id_trabajador" value="{{ old('id_trabajador', $impresion->id_trabajador) }}" required>
        </div>
        <div>
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio', $impresion->fecha_inicio->format('Y-m-d\TH:i')) }}" required>
        </div>
        <div>
            <label for="fecha_fin">Fecha de Fin:</label>
            <input type="datetime-local" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin', $impresion->fecha_fin ? $impresion->fecha_fin->format('Y-m-d\TH:i') : '') }}">
        </div>
        <div>
            <label for="horas_impresion">Horas de Impresión:</label>
            <input type="number" id="horas_impresion" name="horas_impresion" value="{{ old('horas_impresion', $impresion->horas_impresion) }}" required>
        </div>
        <div>
            <label for="dimension_x">Dimensión X:</label>
            <input type="number" step="0.01" id="dimension_x" name="dimension_x" value="{{ old('dimension_x', $impresion->dimension_x) }}" required>
        </div>
        <div>
            <label for="dimension_y">Dimensión Y:</label>
            <input type="number" step="0.01" id="dimension_y" name="dimension_y" value="{{ old('dimension_y', $impresion->dimension_y) }}" required>
        </div>
        <div>
            <label for="dimension_z">Dimensión Z:</label>
            <input type="number" step="0.01" id="dimension_z" name="dimension_z" value="{{ old('dimension_z', $impresion->dimension_z) }}" required>
        </div>
        <button type="submit">Actualizar</button>
    </form>

    <a href="{{ route('impresiones.index') }}">Volver a la lista</a>
@endsection
