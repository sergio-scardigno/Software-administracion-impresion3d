@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Modelo</h1>

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

    <form action="{{ route('modelos.update', $modelo->id_modelo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $modelo->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="dimension_x" class="form-label">Dimensión X</label>
            <input type="number" step="0.01" class="form-control" id="dimension_x" name="dimension_x" value="{{ $modelo->dimension_x }}" required>
        </div>

        <div class="mb-3">
            <label for="dimension_y" class="form-label">Dimensión Y</label>
            <input type="number" step="0.01" class="form-control" id="dimension_y" name="dimension_y" value="{{ $modelo->dimension_y }}" required>
        </div>

        <div class="mb-3">
            <label for="dimension_z" class="form-label">Dimensión Z</label>
            <input type="number" step="0.01" class="form-control" id="dimension_z" name="dimension_z" value="{{ $modelo->dimension_z }}" required>
        </div>

        <div class="mb-3">
            <label for="horas_estimadas" class="form-label">Horas Estimadas</label>
            <input type="number" class="form-control" id="horas_estimadas" name="horas_estimadas" value="{{ $modelo->horas_estimadas }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection
