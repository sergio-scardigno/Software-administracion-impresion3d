@extends('layout')

@section('content')
<h1 class="mb-4">Detalles de la Impresión</h1>

<div class="mb-3">
    <strong>ID:</strong> {{ $impresion->id_impresion }}
</div>
<div class="mb-3">
    <strong>Máquina:</strong> {{ $impresion->id_maquina }}
</div>
<div class="mb-3">
    <strong>Trabajador:</strong> {{ $impresion->id_trabajador }}
</div>
<div class="mb-3">
    <strong>Fecha de Inicio:</strong> {{ $impresion->fecha_inicio }}
</div>
<div class="mb-3">
    <strong>Fecha de Fin:</strong> {{ $impresion->fecha_fin ? $impresion->fecha_fin : 'N/A' }}
</div>
<div class="mb-3">
    <strong>Horas de Impresión:</strong> {{ $impresion->horas_impresion }}
</div>
<div class="mb-3">
    <strong>Dimensiones:</strong> {{ $impresion->dimension_x }} x {{ $impresion->dimension_y }} x {{ $impresion->dimension_z }}
</div>

<div class="mt-3">
    <a href="{{ route('impresiones.index') }}" class="btn btn-secondary">Volver a la lista</a>
    <a href="{{ route('impresiones.edit', $impresion->id_impresion) }}" class="btn btn-warning">Editar</a>

    <form action="{{ route('impresiones.destroy', $impresion->id_impresion) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Eliminar</button>
    </form>
</div>

@endsection
