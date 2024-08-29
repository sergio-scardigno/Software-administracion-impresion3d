<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpresionMaquinaTrabajador extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'impresion_maquina_trabajador';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'id_impresion',
        'id_maquina',
        'id_trabajador',
    ];

    /**
     * Relación con el modelo Impresion
     */
    public function impresion()
    {
        return $this->belongsTo(Impresion::class, 'id_impresion', 'id_impresion');
    }

    /**
     * Relación con el modelo Maquina
     */
    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'id_maquina', 'id_maquina');
    }

    /**
     * Relación con el modelo Trabajador
     */
    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'id_trabajador', 'id_trabajador');
    }
}