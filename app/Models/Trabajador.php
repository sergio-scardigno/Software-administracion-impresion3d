<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $table = 'trabajadores';

    protected $primaryKey = 'id_trabajador';

    protected $fillable = [
        'nombre', 'tipo', 'salario_id', 'costo_por_hora'
    ];

    public function salario()
    {
        return $this->belongsTo(Salario::class, 'salario_id');
    }

    public function impresiones()
    {
        // Relación muchos a muchos con Impresion a través de la tabla intermedia ImpresionMaquinaTrabajador
        return $this->belongsToMany(Impresion::class, 'impresion_maquina_trabajador', 'id_trabajador', 'id_impresion')
                    ->withTimestamps();
    }
}