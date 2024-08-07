<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresion extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_impresion';

    protected $fillable = [
        'id_maquina', 'id_trabajador', 'fecha_inicio', 'fecha_fin', 'horas_impresion', 'dimension_x', 'dimension_y', 'dimension_z'
    ];

    public function maquina()
    {
        return $this->belongsTo(Maquina::class, 'id_maquina');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'id_trabajador');
    }
}