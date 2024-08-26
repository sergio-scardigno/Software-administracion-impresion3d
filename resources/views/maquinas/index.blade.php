@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Lista de Máquinas</h1>
    <a href="{{ route('maquinas.create') }}" class="btn btn-primary mb-3">Crear nueva máquina</a>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Fecha de Compra</th>
                <th>Vida Útil (Años)</th>
                <th>Costo</th>
                <th>Intervalo de Servicio (Horas)</th>
                <th>Costo de Servicio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($maquinas as $maquina)
                <tr>
                    <td>{{ $maquina->nombre }}</td>
                    <td>{{ $maquina->fecha_compra }}</td>
                    <td>{{ $maquina->vida_util_anios }}</td>
                    <td>{{ $maquina->costo }}</td>
                    <td>{{ $maquina->intervalo_servicio_horas }}</td>
                    <td>{{ $maquina->costo_servicio }}</td>
                    <td>
                        <a href="{{ route('maquinas.show', $maquina->id_maquina) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('maquinas.edit', $maquina->id_maquina) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('maquinas.destroy', $maquina->id_maquina) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="my-4">Costo por Hora</h4>
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Máquina</th>
                <th>Costo por Hora (USD)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($maquinas as $maquina)
            <tr>
                <td>{{ $maquina->nombre }}</td>
                <td>{{ number_format($maquina->costo_por_hora, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    
</div>

<p>*Intervalo de Servicio, cantidad de horas que tiene que pasar para realizar un mantenimiento.</p>


@endsection


