<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maquina extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_maquina';

    protected $fillable = [
        'nombre', 
        'fecha_compra', 
        'vida_util_anios', 
        'costo', 
        'intervalo_servicio_horas', 
        'costo_mantenimiento_por_hora',
        'costo_servicio', 
        'wats_consumidas_por_hora',
        'horas_utilizadas'
    ];

    public function impresiones()
    {
        return $this->hasMany(Impresion::class, 'id_maquina');
    }
}