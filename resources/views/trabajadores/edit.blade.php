@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Trabajador</h1>

    <form method="POST" action="{{ route('trabajadores.update', ['trabajador' => $trabajador->id_trabajador]) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ $trabajador->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo:</label>
            <select id="tipo" name="tipo" class="form-select" required>
                @foreach($salarios as $salario)
                    <option value="{{ $salario->id }}" {{ $salario->id == $trabajador->tipo ? 'selected' : '' }}>
                        {{ $salario->tipo_trabajador }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="salario_id" class="form-label">Salario:</label>
            <select id="salario_id" name="salario_id" class="form-select" required>
                @foreach($salarios as $salario)
                    <option value="{{ $salario->id }}" {{ $salario->id == $trabajador->salario_id ? 'selected' : '' }}>
                        {{ $salario->salario_mensual }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Trabajador</button>
        <a href="{{ route('trabajadores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

@endsection
