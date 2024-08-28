<?php

namespace App\Http\Controllers;

use App\Services\DolarCotizacionService;
use App\Models\Cotizacion;
use Carbon\Carbon;


class CotizacionController extends Controller
{
    protected $dolarService;

    public function __construct(DolarCotizacionService $dolarService)
    {
        $this->dolarService = $dolarService;
    }

    public function obtenerCotizacion()
    {
        $fechaActual = Carbon::today(); // Obtiene solo la fecha de hoy (hora establecida a 00:00:00)
    
        $valorDolar = $this->dolarService->obtenerCotizacionDolar();
    
        if ($valorDolar) {
            // Obtener las cotizaciones del mismo día
            $ultimaCotizacion = Cotizacion::whereDate('created_at', $fechaActual)->first();
    
            if (!$ultimaCotizacion) {
                // Guardar la cotización en la base de datos solo si no hay una cotización para hoy
                Cotizacion::create([
                    'valor_dolar' => $valorDolar,
                    'fuente' => 'Dolar API',
                ]);
            }
    
            return response()->json(['valor_dolar' => $valorDolar]);
        }
    
        return response()->json(['error' => 'No se pudo obtener la cotización'], 500);
    }
    
}