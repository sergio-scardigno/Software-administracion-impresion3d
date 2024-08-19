@extends('layout')

@section('content')
    <h1>Lista de Impresiones</h1>
    <a href="{{ route('impresiones.create') }}">Crear Nueva Impresión</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Máquina</th>
            <th>Trabajador</th>
            <th>Fecha de Inicio</th>
            <th>Fecha de Fin</th>
            <th>Horas de Impresión</th>
            <th>Dimensiones</th>
            <th>Acciones</th>
        </tr>
        @foreach ($impresiones as $impresion)
            <tr>
                <td>{{ $impresion->id_impresion }}</td>
                <td>{{ $impresion->id_maquina }}</td>
                <td>{{ $impresion->id_trabajador }}</td>
                <td>{{ $impresion->fecha_inicio }}</td>
                <td>{{ $impresion->fecha_fin }}</td>
                <td>{{ $impresion->horas_impresion }}</td>
                <td>{{ $impresion->dimension_x }} x {{ $impresion->dimension_y }} x {{ $impresion->dimension_z }}</td>
                <td>
                    <a href="{{ route('impresiones.show', $impresion->id_impresion) }}">Ver</a>
                    <a href="{{ route('impresiones.edit', $impresion->id_impresion) }}">Editar</a>
                    <form action="{{ route('impresiones.destroy', $impresion->id_impresion) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
