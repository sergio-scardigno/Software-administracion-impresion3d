@extends('layout')

@section('content')
    <h1>Detalles del Trabajador</h1>

    Nombre: {{ $trabajador->nombre }}
    Tipo: {{ $trabajador->tipo }}
    (Salario ID: {{ $trabajador->salario_id }})

    <a href="{{ route('trabajadores.edit', ['id' => $trabajador->id_trabajador]) }}">Editar</a>
    <form method="POST" action="{{ route('trabajadores.destroy', ['id' => $trabajador->id_trabajador]) }}">
        @csrf
        @method('DELETE')

        <input type="submit" value="Eliminar">
    </form>
@endsection