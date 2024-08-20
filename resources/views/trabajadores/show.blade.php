@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Detalles del Trabajador</h1>

    <div class="mb-3 p-3 border rounded">
        <p><strong>Nombre:</strong> {{ $trabajador->nombre }}</p>
        <p><strong>Tipo:</strong> {{ $trabajador->tipo }}</p>
        <p><strong>Salario ID:</strong> {{ $trabajador->salario_id }}</p>

        <a href="{{ route('trabajadores.edit', ['trabajador' => $trabajador->id_trabajador]) }}" class="btn btn-warning">Editar</a>

        <form method="POST" action="{{ route('trabajadores.destroy', ['trabajador' => $trabajador->id_trabajador]) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>
    </div>
</div>

@endsection