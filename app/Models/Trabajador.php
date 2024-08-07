<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_trabajador';

    protected $fillable = [
        'nombre', 'tipo', 'salario_id'
    ];

    public function salario()
    {
        return $this->belongsTo(Salario::class, 'salario_id');
    }

    public function impresiones()
    {
        return $this->hasMany(Impresion::class, 'id_trabajador');
    }
}