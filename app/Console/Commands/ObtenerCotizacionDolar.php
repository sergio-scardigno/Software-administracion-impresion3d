<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DolarCotizacionService;
use App\Models\Cotizacion;

class ObtenerCotizacionDolar extends Command
{
    protected $signature = 'dolar:obtener';
    protected $description = 'Obtener la cotización del dólar y guardarla en la base de datos';

    protected $dolarService;

    public function __construct(DolarCotizacionService $dolarService)
    {
        parent::__construct();
        $this->dolarService = $dolarService;
    }

    public function handle()
    {
        $valorDolar = $this->dolarService->obtenerCotizacionDolar();

        if ($valorDolar) {
            // Guardar la cotización en la base de datos
            Cotizacion::create([
                'valor_dolar' => $valorDolar,
                'fuente' => 'Dolar API',
            ]);

            $this->info('Cotización del dólar actualizada correctamente.');
        } else {
            $this->error('No se pudo obtener la cotización del dólar.');
        }
    }
}