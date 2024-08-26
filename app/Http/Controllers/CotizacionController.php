<?php

namespace App\Http\Controllers;

use App\Services\DolarCotizacionService;
use App\Models\Cotizacion;

class CotizacionController extends Controller
{
    protected $dolarService;

    public function __construct(DolarCotizacionService $dolarService)
    {
        $this->dolarService = $dolarService;
    }

    public function obtenerCotizacion()
    {
        $valorDolar = $this->dolarService->obtenerCotizacionDolar();

        if ($valorDolar) {
            // Guardar la cotización en la base de datos
            Cotizacion::create([
                'valor_dolar' => $valorDolar,
                'fuente' => 'Dolar API',
            ]);

            return response()->json(['valor_dolar' => $valorDolar]);
        }

        return response()->json(['error' => 'No se pudo obtener la cotización'], 500);
    }
}