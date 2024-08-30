<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImpresionMaterial extends Model
{
    use HasFactory;

    protected $table = 'impresion_material';
    protected $fillable = ['id_impresion', 'id_material', 'cantidad_usada', 'costo'];
}