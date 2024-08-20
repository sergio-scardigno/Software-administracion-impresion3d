@extends('layout')
@section('content')
<div class="container">
    <h1 class="mb-4">Listado de Trabajadores</h1>

    @foreach($trabajadores as $trabajador)
        <div class="mb-3 p-3 border rounded">
            <p><strong>Nombre:</strong> {{ $trabajador->nombre }}</p>
            <p><strong>Tipo:</strong> {{ $trabajador->tipo }}</p>
            <p><strong>Salario ID:</strong> {{ $trabajador->salario_id }}</p>

            <a href="{{ route('trabajadores.edit', ['trabajador' => $trabajador->id_trabajador]) }}" class="btn btn-warning btn-sm">Editar</a>
            <form method="POST" action="{{ route('trabajadores.destroy', ['trabajador' => $trabajador->id_trabajador]) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
            </form>
        </div>
    @endforeach

    <h1 class="mt-4 mb-4">Crear Trabajador</h1>

    <form method="POST" action="{{ route('trabajadores.store') }}">
        @csrf

        <div class="form-group mb-3">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group mb-3">
            <label for="tipo">Tipo:</label>
            <select name="tipo" class="form-control" required>
                @foreach($salarios as $salario)
                    <option value="{{ $salario->id }}">{{ $salario->tipo_trabajador }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="salario_id">Salario:</label>
            <select name="salario_id" class="form-control" required>
                @foreach($salarios as $salario)
                    <option value="{{ $salario->id }}">{{ $salario->salario_mensual }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Trabajador</button>
    </form>
</div>

@endsection