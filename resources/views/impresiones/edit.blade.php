@extends('layout')

@section('content')
<h1 class="mb-4">Editar Impresión</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('impresiones.update', $impresion->id_impresion) }}" method="POST">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label for="maquinas" class="form-label">Máquinas:</label>
        <select id="maquinas" name="maquinas[]" class="form-control" multiple required>
            @foreach ($maquinas as $maquina)
                <option value="{{ $maquina->id_maquina }}"
                    {{ in_array($maquina->id_maquina, $maquinasAsociadas) ? 'selected' : '' }}>
                    {{ $maquina->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="trabajadores" class="form-label">Trabajadores:</label>
        <select id="trabajadores" name="trabajadores[]" class="form-control" multiple required>
            @foreach ($trabajadores as $trabajador)
                <option value="{{ $trabajador->id_trabajador }}"
                    {{ in_array($trabajador->id_trabajador, $trabajadoresAsociados) ? 'selected' : '' }}>
                    {{ $trabajador->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    
    <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio:</label>
        <input type="datetime-local" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio') ? old('fecha_inicio')->format('Y-m-d\TH:i') : '' }}" required>
    </div>
    
    <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de Fin:</label>
        <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin') ? old('fecha_fin')->format('Y-m-d\TH:i') : '' }}">
    </div>
    
    <div class="mb-3">
        <label for="horas_impresion" class="form-label">Horas de Impresión:</label>
        <input type="number" id="horas_impresion" name="horas_impresion" class="form-control" value="{{ old('horas_impresion', $impresion->horas_impresion) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_x" class="form-label">Dimensión X (mm):</label>
        <input type="number" step="0.01" id="dimension_x" name="dimension_x" class="form-control" value="{{ old('dimension_x', $impresion->dimension_x) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_y" class="form-label">Dimensión Y (mm):</label>
        <input type="number" step="0.01" id="dimension_y" name="dimension_y" class="form-control" value="{{ old('dimension_y', $impresion->dimension_y) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="dimension_z" class="form-label">Dimensión Z (mm):</label>
        <input type="number" step="0.01" id="dimension_z" name="dimension_z" class="form-control" value="{{ old('dimension_z', $impresion->dimension_z) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="desperdicio" class="form-label">Desperdicio (g):</label>
        <input type="number" step="0.01" id="desperdicio" name="desperdicio" class="form-control" value="{{ old('desperdicio', $impresion->desperdicio) }}" required>
    </div>

    <div class="mb-3">
        <label for="cantidad_unidades" class="form-label">Cantidad de Unidades:</label>
        <input type="number" id="cantidad_unidades" name="cantidad_unidades" class="form-control" value="{{ old('cantidad_unidades', $impresion->cantidad_unidades) }}" required>
    </div>
    
    <div class="mb-3">
        <label for="venta" class="form-label">Venta (USD):</label>
        <input type="number" step="0.01" id="venta" name="venta" class="form-control" value="{{ old('venta', $impresion->venta) }}" required>
    </div>

    <div class="mb-3">
        <label for="materiales" class="form-label">Materiales:</label>
        @foreach ($materiales as $material)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="materiales[{{ $material->id_material }}][id_material]" value="{{ $material->id_material }}" 
                    {{ isset($materialesAsociados[$material->id_material]) ? 'checked' : '' }}>
                <label class="form-check-label">
                    {{ $material->nombre }}
                </label>
                @if(isset($materialesAsociados[$material->id_material]))
                    <input type="number" step="0.01" name="materiales[{{ $material->id_material }}][cantidad_usada]" value="{{ old('materiales.' . $material->id_material . '.cantidad_usada', $materialesAsociados[$material->id_material]['cantidad_usada']) }}" placeholder="Cantidad usada (g)" class="form-control mt-1">
                    <input type="number" step="0.01" name="materiales[{{ $material->id_material }}][costo]" value="{{ old('materiales.' . $material->id_material . '.costo', $materialesAsociados[$material->id_material]['costo']) }}" placeholder="Costo (ARS)" class="form-control mt-1">
                @endif
            </div>
        @endforeach
    </div>
    
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>

<a href="{{ route('impresiones.index') }}" class="btn btn-secondary mt-3">Volver a la lista</a>

@endsection

