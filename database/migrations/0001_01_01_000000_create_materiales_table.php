<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('materiales', function (Blueprint $table) {
            $table->id('id_material');
            $table->string('nombre');
            $table->decimal('costo_por_unidad', 10, 2);
            $table->decimal('costo_por_gramo', 10, 3);
            $table->string('cantidad_de_material');
            $table->string('unidad_de_medida');
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('materiales');
    }
    
};