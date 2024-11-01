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
    <div class="container">
        <div class="row">
            {{-- Columna para la tabla de materiales --}}
            <div class="col-lg-8 col-md-12 mb-4">
                <table class="table table-bordered table-responsive">
                    <thead class="thead-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Costo por Unidad</th>
                            <th>Unidad de Medida</th>
                            <th>Cantidad de Material</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($materiales as $material)
                        <tr>
                            <td>{{ $material->nombre }}</td>
                            <td>{{ $material->costo_por_unidad }}</td>
                            <td>{{ $material->unidad_de_medida }}</td>
                            <td>{{ $material->cantidad_de_material }}</td>
                            <td>
                                <a href="{{ route('materiales.show', $material->id_material) }}"
                                    class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('materiales.edit', $material->id_material) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('materiales.destroy', $material->id_material) }}" method="POST"
                                    style="display:inline-block;">
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

            {{-- Columna para mostrar los 10 mejores precios --}}
            <div class="col-lg-4 col-md-12">
                <h3>Top 10 Mejores Precios</h3>


                @dump($precios)

                {{-- @if ($precios)
                    @php
                        // Ordenar los precios de menor a mayor
                        $mejoresPrecios = collect($precios)->sortBy('precio')->take(10);
                    @endphp
    
                    <ul class="list-group">
                        @foreach ($mejoresPrecios as $precio)
                            <li class="list-group-item">
                                <strong>{{ $precio['negocio'] }}:</strong>
                {{ $precio['precio'] }}<br>{{ $precio['title'] }}
                </li>
                @endforeach
                </ul>
                @else
                <p>No se pudieron obtener los precios.</p>
                @endif --}}
            </div>
        </div>
    </div>


</div>
@endsection

@vite(['resources/js/conversion-precios-ARS-USD.js'])