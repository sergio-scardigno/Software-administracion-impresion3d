@extends('layout')

@section('content')
    <h1>Listado de Trabajadores</h1>

    @foreach($trabajadores as $trabajador)
        <div>
            Nombre: {{ $trabajador->nombre }}
            Tipo: {{ $trabajador->tipo }}
            (Salario ID: {{ $trabajador->salario_id }})

            <a href="{{ route('trabajadores.edit', ['trabajador' => $trabajador->id_trabajador]) }}">Editar</a>
            <form method="POST" action="{{ route('trabajadores.destroy', ['trabajador' => $trabajador->id_trabajador]) }}">
                @csrf
                @method('DELETE')
            
                <input type="submit" value="Eliminar">
            </form>
        </div>

    @endforeach

    <h1>Crear Trabajador</h1>

    <form method="POST" action="{{ route('trabajadores.store') }}">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br><br>

        <label for="tipo">Tipo:</label>
        <select name="tipo">
            @foreach($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->tipo_trabajador }}</option>
            @endforeach
        </select>


        <label for="salario_id">Salario:</label>
        <select name="salario_id">
            @foreach($salarios as $salario)
                <option value="{{ $salario->id }}">{{ $salario->salario_mensual }}</option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Crear Trabajador">
    </form>
@endsection