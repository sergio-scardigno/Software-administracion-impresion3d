@extends('layout')

@section('content')
    <h1>Lista de Salarios</h1>
    
    <a href="{{ route('salarios.create') }}">Crear nuevo salario</a>
    
    <table>
        <thead>
            <tr>
                <th>Tipo Trabajador</th>
                <th>Salario Mensual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salarios as $salario)
                <tr>
                    <td>{{ $salario->tipo_trabajador }}</td>
                    <td>{{ $salario->salario_mensual }}</td>
                    <td>
                        <a href="{{ route('salarios.show', $salario->id) }}">Ver</a>
                        <a href="{{ route('salarios.edit', $salario->id) }}">Editar</a>
                        <form action="{{ route('salarios.destroy', $salario->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection