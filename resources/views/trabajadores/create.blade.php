@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Trabajador</h1>

    <form method="POST" action="{{ route('trabajadores.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <input type="number" id="tipo" name="tipo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="salario_id" class="form-label">Salario:</label>
            <select id="salario_id" name="salario_id" class="form-select" required>
                @foreach(Salario::all() as $salario)
                    <option value="{{ $salario->id }}">{{ $salario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Trabajador</button>
    </form>
</div>

@endsection