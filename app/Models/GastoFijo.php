<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoFijo extends Model
{
    use HasFactory;

    protected $table = 'gastos_fijos'; // Nombre de la tabla correcta

    protected $primaryKey = 'id_gasto';

    protected $fillable = [
        'tipo_gasto', 'monto', 'categoria'
    ];
}