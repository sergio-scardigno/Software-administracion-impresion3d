@extends('layout')

@section('content')
    <h1>Editar Trabajador</h1>

    <form method="POST" action="{{ route('trabajadores.update', ['trabajador' => $trabajador->id_trabajador]) }}">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="{{ $trabajador->nombre }}" required><br><br>

        <label for="tipo">Tipo:</label>
        <select name="tipo">
            @foreach($salarios as $salario)
                <option value="{{ $salario->id }}" {{ $salario->id == $trabajador->tipo ? 'selected' : '' }}>
                    {{ $salario->tipo_trabajador }}
                </option>
            @endforeach
        </select><br><br>

        <label for="salario_id">Salario:</label>
        <select name="salario_id">
            @foreach($salarios as $salario)
                <option value="{{ $salario->id }}" {{ $salario->id == $trabajador->salario_id ? 'selected' : '' }}>
                    {{ $salario->salario_mensual }}
                </option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Editar Trabajador">
    </form>
@endsection
