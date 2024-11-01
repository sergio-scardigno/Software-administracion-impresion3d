@extends('layout')

@section('content')
<div class="container">
    <h1>Editar Material</h1>

    <form action="{{ route('materiales.update', $material->id_material) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $material->nombre) }}" required>
        </div>
        <div class="form-group">
            <label for="costo_por_unidad">Costo por Unidad</label>
            <input type="text" class="form-control" id="costo_por_unidad" name="costo_por_unidad" value="{{ old('costo_por_unidad', $material->costo_por_unidad) }}" required>
        </div>
        <div class="form-group">
            <label for="unidad_de_medida">Unidad de Medida</label>
            <input type="text" class="form-control" id="unidad_de_medida" name="unidad_de_medida" value="{{ old('unidad_de_medida', $material->unidad_de_medida) }}" required>
        </div>
        <div class="form-group">
            <label for="cantidad_de_material">Cantidad de Material</label>
            <input type="text" class="form-control" id="cantidad_de_material" name="cantidad_de_material" value="{{ old('cantidad_de_material', $material->cantidad_de_material) }}" required>
        </div>
        <div class="form-group">
            <label for="costo_por_gramo">Costo por Gramo</label>
            <input type="text" class="form-control" id="costo_por_gramo" name="costo_por_gramo" value="{{ old('costo_por_gramo', $material->costo_por_gramo) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
