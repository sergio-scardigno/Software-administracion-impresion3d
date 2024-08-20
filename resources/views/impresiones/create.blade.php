@extends('layout')

@section('content')
<h1 class="mb-4">Crear Nueva Impresión</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('impresiones.store') }}" method="POST">
    @csrf
    
    <div class="mb-3">
        <label for="id_maquina" class="form-label">Máquina:</label>
        <select id="id_maquina" name="id_maquina" class="form-select" required>
            <option value="" disabled selected>Selecciona una máquina</option>
            @foreach ($maquinas as $maquina)

                <option value="{{ $maquina->id_maquina }}">{{ $maquina->nombre }}</option>

            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="id_trabajador" class="form-label">Trabajador:</label>
        <select id="id_trabajador" name="id_trabajador" class="form-select" required>
            <option value="" disabled selected>Selecciona un trabajador</option>
            @foreach ($trabajadores as $trabajador)

                <option value="{{ $trabajador->id_trabajador }}">{{ $trabajador->nombre }}</option>

            @endforeach
        </select>
    </div>
    
    
    
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="horas_impresion" class="form-label">Horas de Impresión:</label>
        <input type="number" id="horas_impresion" name="horas_impresion" class="form-control" value="{{ old('horas_impresion') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_x" class="form-label">Dimensión X:</label>
        <input type="number" step="0.01" id="dimension_x" name="dimension_x" class="form-control" value="{{ old('dimension_x') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_y" class="form-label">Dimensión Y:</label>
        <input type="number" step="0.01" id="dimension_y" name="dimension_y" class="form-control" value="{{ old('dimension_y') }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_z" class="form-label">Dimensión Z:</label>
        <input type="number" step="0.01" id="dimension_z" name="dimension_z" class="form-control" value="{{ old('dimension_z') }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Crear</button>
</form>

<a href="{{ route('impresiones.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>


@endsection
