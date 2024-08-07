<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_modelo';

    protected $fillable = [
        'nombre', 'dimension_x', 'dimension_y', 'dimension_z', 'horas_estimadas'
    ];
}