<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salario extends Model
{
    use HasFactory;

    protected $table = 'salarios';

    protected $primaryKey = 'id';

    protected $fillable = [
        'tipo_trabajador', 'salario_mensual'
    ];

    public function trabajadores()
    {
        return $this->hasMany(Trabajador::class, 'salario_id');
    }
}