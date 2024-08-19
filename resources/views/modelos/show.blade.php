@extends('layout')

@section('content')
    <div class="container">
        <h1>Detalles del Modelo</h1>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $modelo->nombre }}" readonly>
        </div>
        <div class="form-group">
            <label for="dimension_x">Dimensión X</label>
            <input type="text" class="form-control" id="dimension_x" name="dimension_x" value="{{ $modelo->dimension_x }}" readonly>
        </div>
        <div class="form-group">
            <label for="dimension_y">Dimensión Y</label>
            <input type="text" class="form-control" id="dimension_y" name="dimension_y" value="{{ $modelo->dimension_y }}" readonly>
        </div>
        <div class="form-group">
            <label for="dimension_z">Dimensión Z</label>
            <input type="text" class="form-control" id="dimension_z" name="dimension_z" value="{{ $modelo->dimension_z }}" readonly>
        </div>
        <div class="form-group">
            <label for="horas_estimadas">Horas Estimadas</label>
            <input type="text" class="form-control" id="horas_estimadas" name="horas_estimadas" value="{{ $modelo->horas_estimadas }}" readonly>
        </div>
        <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('modelos.edit', $modelo->id_modelo) }}" class="btn btn-warning">Editar</a>
    </div>
@endsection
