<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('impresion_material', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_impresion');
            $table->unsignedBigInteger('id_material');
            $table->decimal('cantidad_usada', 10, 2);
            $table->decimal('costo', 10, 2);
            $table->timestamps();
    
            // Relaciones con otras tablas
            $table->foreign('id_impresion')->references('id_impresion')->on('impresiones')->onDelete('cascade');
            $table->foreign('id_material')->references('id_material')->on('materiales')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('impresion_material');
    }
    
    
};