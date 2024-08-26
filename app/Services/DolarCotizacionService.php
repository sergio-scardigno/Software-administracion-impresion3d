<?php


namespace App\Services;

class DolarCotizacionService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = "https://dolarapi.com/v1/dolares/blue";
    }

    public function obtenerCotizacionDolar()
    {
        try {
            $response = file_get_contents($this->apiUrl);

            if ($response === false) {
                throw new \Exception('Error al obtener la cotización del dólar.');
            }

            $data = json_decode($response, true);

            // Depura la respuesta
            \Log::info('Respuesta de la API de Dolar:', $data);

            return $data['venta'] ?? null;
        } catch (\Exception $e) {
            \Log::error('Error al obtener la cotización del dólar: ' . $e->getMessage());
            return null;
        }
    }
}