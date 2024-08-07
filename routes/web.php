<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\GastoFijoController;
use App\Http\Controllers\SalarioController;
use App\Http\Controllers\ImpresionController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ModeloController;

Route::resource('maquinas', MaquinaController::class);
Route::resource('gastos-fijos', GastoFijoController::class);
Route::resource('salarios', SalarioController::class);
Route::resource('impresiones', ImpresionController::class);
Route::resource('trabajadores', TrabajadorController::class);
Route::resource('modelos', ModeloController::class);

Route::get('/', function () {
    return view('welcome');
});