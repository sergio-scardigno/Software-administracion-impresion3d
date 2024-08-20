@extends('layout')

@section('content')
<h1 class="mb-4">Editar Impresión</h1>

@if ($errors->any())
    <div class="alert alert-danger">
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
    
    <div class="mb-3">
        <label for="id_maquina" class="form-label">Máquina:</label>
        <input type="number" id="id_maquina" name="id_maquina" class="form-control" value="{{ old('id_maquina', $impresion->id_maquina) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="id_trabajador" class="form-label">Trabajador:</label>
        <input type="number" id="id_trabajador" name="id_trabajador" class="form-control" value="{{ old('id_trabajador', $impresion->id_trabajador) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $impresion->fecha_inicio->format('Y-m-d\TH:i')) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
        <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $impresion->fecha_fin ? $impresion->fecha_fin->format('Y-m-d\TH:i') : '') }}">
    </div>
    
    <div class="mb-3">
        <label for="horas_impresion" class="form-label">Horas de Impresión:</label>
        <input type="number" id="horas_impresion" name="horas_impresion" class="form-control" value="{{ old('horas_impresion', $impresion->horas_impresion) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_x" class="form-label">Dimensión X:</label>
        <input type="number" step="0.01" id="dimension_x" name="dimension_x" class="form-control" value="{{ old('dimension_x', $impresion->dimension_x) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_y" class="form-label">Dimensión Y:</label>
        <input type="number" step="0.01" id="dimension_y" name="dimension_y" class="form-control" value="{{ old('dimension_y', $impresion->dimension_y) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_z" class="form-label">Dimensión Z:</label>
        <input type="number" step="0.01" id="dimension_z" name="dimension_z" class="form-control" value="{{ old('dimension_z', $impresion->dimension_z) }}" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<a href="{{ route('impresiones.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>

@endsection
