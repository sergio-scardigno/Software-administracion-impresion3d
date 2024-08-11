@extends('layout')

@section('content')
    <h1>Ver Salario</h1>
    
    <p>Tipo Trabajador: {{ $salario->tipo_trabajador }}</p>
    <p>Salario Mensual: {{ $salario->salario_mensual }}</p>
@endsection