@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Gastos Fijos</h1>
    
    <a href="{{ route('gastos_fijos.create') }}" class="btn btn-primary mb-3">Agregar Gasto Fijo</a>
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tipo de Gasto</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($gastosFijos as $gasto)
                <tr>
                    <td>{{ $gasto->id_gasto }}</td>
                    <td>{{ $gasto->tipo_gasto }}</td>
                    <td>{{ $gasto->monto }}</td>
                    <td>
                        <a href="{{ route('gastos_fijos.show', $gasto->id_gasto) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('gastos_fijos.edit', $gasto->id_gasto) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('gastos_fijos.destroy', $gasto->id_gasto) }}" method="POST" style="display:inline;">
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

@endsection
