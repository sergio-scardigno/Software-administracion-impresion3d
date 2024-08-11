@extends('layout')

@section('content')
    <h1>Crear Trabajador</h1>

    <form method="POST" action="{{ route('trabajadores.store') }}">
        @csrf

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre"><br><br>

        <label for="tipo">Tipo:</label>
        <input type="number" name="tipo"><br><br>

        <label for="salario_id">Salario:</label>
        <select name="salario_id">
            @foreach(Salario::all() as $salario)
                <option value="{{ $salario->id }}">{{ $salario->nombre }}</option>
            @endforeach
        </select><br><br>

        <input type="submit" value="Crear Trabajador">
    </form>
@endsection