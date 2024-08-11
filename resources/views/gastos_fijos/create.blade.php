@extends('layout')

@section('content')
    <div class="container">
        <h1>Agregar Gasto Fijo</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    


        <form action="{{ route('gastos_fijos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="tipo_gasto" class="form-label">Tipo de Gasto</label>
                <input type="text" class="form-control" id="tipo_gasto" name="tipo_gasto" value="{{ old('tipo_gasto') }}">
            </div>
            <div class="mb-3">
                <label for="monto" class="form-label">Monto</label>
                <input type="text" class="form-control" id="monto" name="monto" value="{{ old('monto') }}">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
