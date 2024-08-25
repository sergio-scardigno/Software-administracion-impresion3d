@extends('layout')

@section('content')
<div class="container">
    <h1>Materiales</h1>
    <a href="{{ route('materiales.create') }}" class="btn btn-primary mb-3">Agregar Material</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Costo por Unidad</th>
            <th>Unidad de Medida</th>
            <th>Cantidad de Material</th>
            <th>Acciones</th>
        </tr>
        @foreach ($materiales as $material)
        <tr>
            <td>{{ $material->id_material }}</td>
            <td>{{ $material->nombre }}</td>
            <td>{{ $material->costo_por_unidad }}</td>
            <td>{{ $material->unidad_de_medida }}</td>
            <td>{{ $material->cantidad_de_material }}</td>
            
            <td>
                <a href="{{ route('materiales.show', $material->id_material) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('materiales.edit', $material->id_material) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('materiales.destroy', $material->id_material) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
