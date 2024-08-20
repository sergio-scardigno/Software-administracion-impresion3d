@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Modelos</h1>
    <a href="{{ route('modelos.create') }}" class="btn btn-primary mb-3">Crear Modelo</a>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dimensión X</th>
                <th>Dimensión Y</th>
                <th>Dimensión Z</th>
                <th>Horas Estimadas</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modelos as $modelo)
                <tr>
                    <td>{{ $modelo->id_modelo }}</td>
                    <td>{{ $modelo->nombre }}</td>
                    <td>{{ $modelo->dimension_x }}</td>
                    <td>{{ $modelo->dimension_y }}</td>
                    <td>{{ $modelo->dimension_z }}</td>
                    <td>{{ $modelo->horas_estimadas }}</td>
                    <td>
                        <a href="{{ route('modelos.show', $modelo->id_modelo) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('modelos.edit', $modelo->id_modelo) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('modelos.destroy', $modelo->id_modelo) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
