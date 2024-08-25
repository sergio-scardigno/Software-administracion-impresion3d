<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materiales';

    protected $primaryKey = 'id_material';

    protected $fillable = ['nombre', 'costo_por_unidad', 'unidad_de_medida', 'cantidad_de_material'];

    public function impresiones()
    {
        return $this->belongsToMany(Impresion::class, 'impresion_material', 'id_material', 'id_impresion')
                    ->withPivot('cantidad_usada', 'costo')
                    ->withTimestamps();
    }
}