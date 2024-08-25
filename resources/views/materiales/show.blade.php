@extends('layout')

@section('content')
<div class="container">
    <h1>Detalle del Material</h1>
    <p><strong>ID:</strong> {{ $material->id_material }}</p>
    <p><strong>Nombre:</strong> {{ $material->nombre }}</p>
    <p><strong>Costo por Unidad:</strong> {{ $material->costo_por_unidad }}</p>
    <p><strong>Unidad de Medida:</strong> {{ $material->unidad_de_medida }}</p>
    <p><strong>Cantidad de Material:</strong> {{ $material->cantidad_de_material }}</p>
    
    <a href="{{ route('materiales.index') }}" class="btn btn-primary">Volver</a>
</div>
@endsection
