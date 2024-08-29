@extends('layout')

@section('content')
<h1 class="mb-4">Crear Nueva Impresión</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('impresiones.store') }}" method="POST">
    @csrf

    <!-- Selección múltiple de máquinas -->
    <div class="mb-3">
        <label for="id_maquina" class="form-label">Máquinas:</label>
        <select id="id_maquina" name="id_maquina[]" class="form-select select2" multiple="multiple" required>
            @foreach ($maquinas as $maquina)
                <option value="{{ $maquina->id_maquina }}">{{ $maquina->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Selección múltiple de trabajadores -->
    <div class="mb-3">
        <label for="id_trabajador" class="form-label">Trabajadores:</label>
        <select id="id_trabajador" name="id_trabajador[]" class="form-select select2" multiple="multiple" required>
            @foreach ($trabajadores as $trabajador)
                <option value="{{ $trabajador->id_trabajador }}">{{ $trabajador->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') }}" required>
    </div>

    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
        <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') }}" required>
    </div>

    <div class="mb-3">
        <label for="horas_impresion" class="form-label">Horas de Impresión:</label>
        <input type="number" id="horas_impresion" name="horas_impresion" class="form-control" value="{{ old('horas_impresion') }}" required>
    </div>

    <div class="mb-3">
        <label for="dimension_x" class="form-label">Dimensión X:</label>
        <input type="number" step="0.01" id="dimension_x" name="dimension_x" class="form-control" value="{{ old('dimension_x') }}" required>
    </div>

    <div class="mb-3">
        <label for="dimension_y" class="form-label">Dimensión Y:</label>
        <input type="number" step="0.01" id="dimension_y" name="dimension_y" class="form-control" value="{{ old('dimension_y') }}" required>
    </div>

    <div class="mb-3">
        <label for="dimension_z" class="form-label">Dimensión Z:</label>
        <input type="number" step="0.01" id="dimension_z" name="dimension_z" class="form-control" value="{{ old('dimension_z') }}" required>
    </div>

    <div class="mb-3">
        <label for="cantidad_unidades" class="form-label">Cantidad de Unidades:</label>
        <input type="number" id="cantidad_unidades" name="cantidad_unidades" class="form-control" value="{{ old('cantidad_unidades') }}" required>
    </div>

    <div class="mb-3">
        <label for="venta" class="form-label">Precio de Venta:</label>
        <input type="number" step="0.01" id="venta" name="venta" class="form-control" value="{{ old('venta') }}" required>
    </div>

    <div class="mb-3">
        <label for="desperdicio" class="form-label">Desperdicio en Kilos:</label>
        <input type="number" step="0.01" id="desperdicio" name="desperdicio" class="form-control" value="{{ old('desperdicio') }}" required>
    </div>

    <!-- Materiales Dinámicos -->
    <div id="materiales-container">
        <div class="material-group">
            <div class="mb-3">
                <label for="materiales[0][id_material]" class="form-label">Material:</label>
                <select id="materiales[0][id_material]" name="materiales[0][id_material]" class="form-select select2" required>
                    <option value="" disabled selected>Selecciona un material</option>
                    @foreach ($materiales as $material)
                        <option value="{{ $material->id_material }}">{{ $material->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="materiales[0][cantidad_usada]" class="form-label">Cantidad Usada en Kilos de Material:</label>
                <input type="number" step="0.01" id="materiales[0][cantidad_usada]" name="materiales[0][cantidad_usada]" class="form-control" value="{{ old('materiales[0][cantidad_usada]') }}" required>
            </div>

            <div class="mb-3">
                <label for="materiales[0][costo]" class="form-label">Costo del Material:</label>
                <input type="number" step="0.01" id="materiales[0][costo]" name="materiales[0][costo]" class="form-control" value="{{ old('materiales[0][costo]') }}" required>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-secondary" onclick="agregarMaterial()">Agregar Otro Material</button>

    <p id="costoSugerido">Costo Sugerido del Producto: $0.00</p>

    <button type="button" class="btn btn-info" onclick="calcularCosto()">Calcular Costo</button>

    <button type="submit" class="btn btn-primary">Crear</button>
</form>

<a href="{{ route('impresiones.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>

@endsection

@vite(['resources/js/all.js', 'resources/js/costos.js'])

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Selecciona una opción",
            allowClear: true
        });
    });

    let materialCount = 1;

    function agregarMaterial() {
        const container = document.getElementById('materiales-container');
        const newMaterialGroup = document.createElement('div');
        newMaterialGroup.classList.add('material-group');

        newMaterialGroup.innerHTML = `
            <div class="mb-3">
                <label for="materiales[${materialCount}][id_material]" class="form-label">Material:</label>
                <select id="materiales[${materialCount}][id_material]" name="materiales[${materialCount}][id_material]" class="form-select select2" required>
                    <option value="" disabled selected>Selecciona un material</option>
                    @foreach ($materiales as $material)
                        <option value="{{ $material->id_material }}">{{ $material->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label for="materiales[${materialCount}][cantidad_usada]" class="form-label">Cantidad Usada en Kilos de Material:</label>
                <input type="number" step="0.01" id="materiales[${materialCount}][cantidad_usada]" name="materiales[${materialCount}][cantidad_usada]" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="materiales[${materialCount}][costo]" class="form-label">Costo del Material:</label>
                <input type="number" step="0.01" id="materiales[${materialCount}][costo]" name="materiales[${materialCount}][costo]" class="form-control" required>
            </div>
        `;

        container.appendChild(newMaterialGroup);
        $('.select2').select2({
            placeholder: "Selecciona una opción",
            allowClear: true
        });
        materialCount++;
    }

    function calcularCosto() {
        // Lógica para calcular el costo sugerido
        let costoSugerido = 0;
        // Calcular costo basado en los materiales y otros inputs
        document.getElementById('costoSugerido').innerText = `Costo Sugerido del Producto: $${costoSugerido.toFixed(2)}`;
    }
</script>
