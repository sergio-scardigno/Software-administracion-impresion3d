@extends('layout')

@section('content')
<div class="container">
    <h1>Agregar Material</h1>

    <form action="{{ route('materiales.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="costo_por_unidad">Costo por Unidad</label>
            <input type="text" class="form-control" id="costo_por_unidad" name="costo_por_unidad" required>
        </div>
        <div class="form-group">
            <label for="unidad_de_medida">Unidad de Medida</label>
            <input type="text" class="form-control" id="unidad_de_medida" name="unidad_de_medida" required>
        </div>
        <div class="form-group">
            <label for="cantidad_de_material">Cantidad de Material</label>
            <input type="text" class="form-control" id="cantidad_de_material" name="cantidad_de_material" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection
