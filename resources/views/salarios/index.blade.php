@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Salarios</h1>

    <a href="{{ route('salarios.create') }}" class="btn btn-primary mb-3">Crear nuevo salario</a>

    <table class="table table-bordered">
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
                        <a href="{{ route('salarios.show', $salario->id) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('salarios.edit', $salario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('salarios.destroy', $salario->id) }}" method="POST" style="display:inline-block;">
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