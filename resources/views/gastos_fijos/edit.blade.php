@extends('layout')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Gasto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- <pre>{{ var_dump($gastoFijo) }}</pre> --}}

    <form action="{{ route('gastos_fijos.update', $gastoFijo->id_gasto) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="tipo_gasto" class="form-label">Tipo de Gasto</label>
            <input type="text" class="form-control" id="tipo_gasto" name="tipo_gasto" value="{{ old('tipo_gasto', $gastoFijo->tipo_gasto) }}" required>
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="text" class="form-control" id="monto" name="monto" value="{{ old('monto', $gastoFijo->monto) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <a href="{{ route('gastos_fijos.index') }}" class="btn btn-secondary mt-3">Volver</a>
</div>

@endsection
