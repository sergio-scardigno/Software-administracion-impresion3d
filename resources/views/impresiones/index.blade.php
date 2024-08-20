@extends('layout')

@section('content')
<h1 class="mb-4">Lista de Impresiones</h1>

<a href="{{ route('impresiones.create') }}" class="btn btn-primary mb-3">Crear Nueva Impresión</a>

<table class="table table-striped">
    <thead>
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
    </thead>
    <tbody>
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
                    <a href="{{ route('impresiones.show', $impresion->id_impresion) }}" class="btn btn-info btn-sm">Ver</a>
                    <a href="{{ route('impresiones.edit', $impresion->id_impresion) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('impresiones.destroy', $impresion->id_impresion) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
