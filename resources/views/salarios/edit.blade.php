@extends('layout')

@section('content')
    <h1>Editar Salario</h1>

    {{ $salario->id; }}
    
    <form action="{{ route('salarios.update', $salario->id) }}" method="POST">
        @csrf
        @method('PUT')
                
        <div class="form-group">
            <label for="tipo_trabajador">Tipo Trabajador:</label>
            <input type="text" id="tipo_trabajador" name="tipo_trabajador" value="{{ $salario->tipo_trabajador }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="salario_mensual">Salario Mensual:</label>
            <input type="number" id="salario_mensual" name="salario_mensual" value="{{ $salario->salario_mensual }}" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection