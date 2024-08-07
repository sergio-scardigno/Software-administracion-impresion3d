@extends('layout')

@section('content')
    <h1>Lista de Máquinas</h1>
    <a href="{{ route('maquinas.create') }}">Crear nueva máquina</a>
    <table>
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
                        <a href="{{ route('maquinas.show', $maquina->id_maquina) }}">Ver</a>
                        <a href="{{ route('maquinas.edit', $maquina->id_maquina) }}">Editar</a>
                        <form action="{{ route('maquinas.destroy', $maquina->id_maquina) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
