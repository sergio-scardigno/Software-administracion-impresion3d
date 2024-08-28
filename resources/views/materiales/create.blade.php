@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-md-12 mb-4">
            <h1>Agregar Material</h1>

            <form id="materialForm" action="{{ route('materiales.store') }}" method="POST">
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
                    <label for="moneda">Moneda</label>
                    <select class="form-control" id="moneda" name="moneda" required>
                        <option value="USD">Dólares</option>
                        <option value="ARS">Pesos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="unidad_de_medida">Unidad de Medida</label>
                    <select class="form-control" id="unidad_de_medida" name="unidad_de_medida" required>
                        <option value="KG">KG</option>
                        <option value="GR">GR</option>
                    </select>
                </div>        
                <div class="form-group">
                    <label for="cantidad_de_material">Cantidad de Material en KG o GR</label>
                    <input type="text" class="form-control" id="cantidad_de_material" name="cantidad_de_material" list="cantidades" required>
                    <datalist id="cantidades">
                            <option value="250" label="250 GR">
                            <option value="500" label="500 GR">
                            <option value="750" label="750 GR">
                            <option value="1000" label="1 KG"> <!-- 1000 GR -->
                            <option value="2000" label="2 KG"> <!-- 2000 GR -->
                            <option value="3000" label="3 KG"> <!-- 3000 GR -->
                            <option value="4000" label="4 KG"> <!-- 4000 GR -->
                            <option value="5000" label="5 KG"> <!-- 5000 GR -->
                            <option value="6000" label="6 KG"> <!-- 6000 GR -->
                            <option value="7000" label="7 KG"> <!-- 7000 GR -->
                            <option value="8000" label="8 KG"> <!-- 8000 GR -->
                            <option value="9000" label="9 KG"> <!-- 9000 GR -->
                            <option value="10000" label="10 KG"> <!-- 10000 GR -->
                            <option value="15000" label="15 KG"> <!-- 15000 GR -->
                    </datalist>
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
        <div class="col-lg-6 col-md-12 mb-4">
            <div id="resultados" class="mt-3">
                <!-- Aquí se mostrarán los resultados de la API -->
            </div>
        </div>
    </div>
    <div class="container">
                    <h3>Top 10 Mejores Precios Consultados de la Base de Datos</h3>
        
    </div>

    
</div>
@endsection

@vite(['resources/js/conversion-precios-ARS-USD.js', 'resources/js/consulta-precios.js' ])
