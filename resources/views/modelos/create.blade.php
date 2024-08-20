@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Modelo</h1>

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

    <form action="{{ route('modelos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>

        <div class="mb-3">
            <label for="dimension_x" class="form-label">Dimensión X</label>
            <input type="number" step="0.01" class="form-control" id="dimension_x" name="dimension_x" required>
        </div>

        <div class="mb-3">
            <label for="dimension_y" class="form-label">Dimensión Y</label>
            <input type="number" step="0.01" class="form-control" id="dimension_y" name="dimension_y" required>
        </div>

        <div class="mb-3">
            <label for="dimension_z" class="form-label">Dimensión Z</label>
            <input type="number" step="0.01" class="form-control" id="dimension_z" name="dimension_z" required>
        </div>

        <div class="mb-3">
            <label for="horas_estimadas" class="form-label">Horas Estimadas</label>
            <input type="number" class="form-control" id="horas_estimadas" name="horas_estimadas" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('modelos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection
