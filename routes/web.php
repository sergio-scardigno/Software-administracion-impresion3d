<?php
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request; 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\GastoFijoController;
use App\Http\Controllers\SalarioController;
use App\Http\Controllers\ImpresionController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\CotizacionController;


Route::resource('maquinas', MaquinaController::class);
Route::resource('gastos_fijos', GastoFijoController::class);
Route::resource('salarios', SalarioController::class);
Route::resource('impresiones', ImpresionController::class);
Route::resource('trabajadores', TrabajadorController::class)->parameters([
    'trabajadores' => 'trabajador'
]);

Route::resource('modelos', ModeloController::class);
Route::resource('materiales', MaterialController::class);

Route::get('/maquinas/{id}/datos', [MaquinaController::class, 'obtenerDatos']);
Route::get('/trabajadores/{id}/datos', [TrabajadorController::class, 'obtenerDatos']);
Route::get('/materiales/{id}/datos', [MaterialController::class, 'obtenerDatos']);

Route::get('/cotizacion', [CotizacionController::class, 'obtenerCotizacion']);

Route::get('/proxy/precios', function (Request $request) {
    $response = Http::get('https://insumos-3d-api.vercel.app/precios?', [
        'search' => $request->query('search')
    ]);

    return $response->body();
});

Route::get('/', function () {
    return view('welcome');
});