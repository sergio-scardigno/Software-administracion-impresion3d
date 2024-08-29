<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Impresion extends Model
{
    use HasFactory;

    protected $table = 'impresiones';

    protected $primaryKey = 'id_impresion';

    protected $fillable = [
        'id_maquina', 
        'id_trabajador', 
        'fecha_inicio', 
        'fecha_fin', 
        'horas_impresion', 
        'dimension_x', 
        'dimension_y', 
        'dimension_z',
        'desperdicio', 
        'cantidad_unidades', 
        'venta',
        'precio_venta'
    ];

    public function maquinas()
    {
        // Relación muchos a muchos con Maquina a través de la tabla intermedia ImpresionMaquinaTrabajador
        return $this->belongsToMany(Maquina::class, 'impresion_maquina_trabajador', 'id_impresion', 'id_maquina')
                    ->withTimestamps();
    }

    public function trabajadores()
    {
        // Relación muchos a muchos con Trabajador a través de la tabla intermedia ImpresionMaquinaTrabajador
        return $this->belongsToMany(Trabajador::class, 'impresion_maquina_trabajador', 'id_impresion', 'id_trabajador')
                    ->withTimestamps();
    }

    public function materiales()
    {
        // Relación muchos a muchos con Material a través de la tabla intermedia ImpresionMaterial
        return $this->belongsToMany(Material::class, 'impresion_material', 'id_impresion', 'id_material')
                    ->withPivot('cantidad_usada', 'costo')
                    ->withTimestamps();
    }
}