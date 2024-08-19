@extends('layout')

@section('content')
    <div class="container">
        <h1>Editar Modelo</h1>
        <form action="{{ route('modelos.update', $modelo->id_modelo) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $modelo->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="dimension_x">Dimensión X</label>
                <input type="number" step="0.01" class="form-control" id="dimension_x" name="dimension_x" value="{{ $modelo->dimension_x }}" required>
            </div>
            <div class="form-group">
                <label for="dimension_y">Dimensión Y</label>
                <input type="number" step="0.01" class="form-control" id="dimension_y" name="dimension_y" value="{{ $modelo->dimension_y }}" required>
            </div>
            <div class="form-group">
                <label for="dimension_z">Dimensión Z</label>
                <input type="number" step="0.01" class="form-control" id="dimension_z" name="dimension_z" value="{{ $modelo->dimension_z }}" required>
            </div>
            <div class="form-group">
                <label for="horas_estimadas">Horas Estimadas</label>
                <input type="number" class="form-control" id="horas_estimadas" name="horas_estimadas" value="{{ $modelo->horas_estimadas }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
