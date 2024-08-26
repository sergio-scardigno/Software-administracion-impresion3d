<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    use HasFactory;

    // Definir la tabla asociada al modelo (opcional si el nombre es igual al plural del modelo)
    protected $table = 'cotizaciones';

    // Indica los campos que se pueden llenar masivamente
    protected $fillable = [
        'valor_dolar',
        'fecha',
        'fuente',
    ];

    // Si el campo `fecha` se almacena como timestamp, Laravel lo tratará automáticamente.
    // Si `fecha` no sigue la convención `created_at` y `updated_at`, se puede personalizar el formato:
    protected $casts = [
        'fecha' => 'datetime',
    ];
}