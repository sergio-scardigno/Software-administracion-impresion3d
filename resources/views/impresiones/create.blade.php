@extends('layout')

@section('content')
    <h1>Crear Nueva Impresión</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('impresiones.store') }}" method="POST">
        @csrf
        <div>
            <label for="id_maquina">Máquina:</label>
            <input type="number" id="id_maquina" name="id_maquina" value="{{ old('id_maquina') }}" required>
        </div>
        <div>
            <label for="id_trabajador">Trabajador:</label>
            <input type="number" id="id_trabajador" name="id_trabajador" value="{{ old('id_trabajador') }}" required>
        </div>
        <div>
            <label for="fecha_inicio">Fecha de Inicio:</label>
            <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required>
        </div>
        <div>
            <label for="horas_impresion">Horas de Impresión:</label>
            <input type="number" id="horas_impresion" name="horas_impresion" value="{{ old('horas_impresion') }}" required>
        </div>
        <div>
            <label for="dimension_x">Dimensión X:</label>
            <input type="number" step="0.01" id="dimension_x" name="dimension_x" value="{{ old('dimension_x') }}" required>
        </div>
        <div>
            <label for="dimension_y">Dimensión Y:</label>
            <input type="number" step="0.01" id="dimension_y" name="dimension_y" value="{{ old('dimension_y') }}" required>
        </div>
        <div>
            <label for="dimension_z">Dimensión Z:</label>
            <input type="number" step="0.01" id="dimension_z" name="dimension_z" value="{{ old('dimension_z') }}" required>
        </div>
        <button type="submit">Crear</button>
    </form>

    <a href="{{ route('impresiones.index') }}">Volver a la lista</a>
@endsection
