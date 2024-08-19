@extends('layout')

@section('content')
    <h1>Detalles de la Impresión</h1>

    <div>
        <strong>ID:</strong> {{ $impresion->id_impresion }}
    </div>
    <div>
        <strong>Máquina:</strong> {{ $impresion->id_maquina }}
    </div>
    <div>
        <strong>Trabajador:</strong> {{ $impresion->id_trabajador }}
    </div>
    <div>
        <strong>Fecha de Inicio:</strong> {{ $impresion->fecha_inicio }}
    </div>
    <div>
        <strong>Fecha de Fin:</strong> {{ $impresion->fecha_fin ? $impresion->fecha_fin : 'N/A' }}
    </div>
    <div>
        <strong>Horas de Impresión:</strong> {{ $impresion->horas_impresion }}
    </div>
    <div>
        <strong>Dimensiones:</strong> {{ $impresion->dimension_x }} x {{ $impresion->dimension_y }} x {{ $impresion->dimension_z }}
    </div>

    <a href="{{ route('impresiones.index') }}">Volver a la lista</a>
    <a href="{{ route('impresiones.edit', $impresion->id_impresion) }}">Editar</a>

    <form action="{{ route('impresiones.destroy', $impresion->id_impresion) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit">Eliminar</button>
    </form>
@endsection
