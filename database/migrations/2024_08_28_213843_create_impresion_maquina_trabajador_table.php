<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('impresion_maquina_trabajador', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_impresion');
            $table->unsignedBigInteger('id_maquina');
            $table->unsignedBigInteger('id_trabajador');
            $table->timestamps();

            // Relaciones con otras tablas
            $table->foreign('id_impresion')->references('id_impresion')->on('impresiones')->onDelete('cascade');
            $table->foreign('id_maquina')->references('id_maquina')->on('maquinas')->onDelete('cascade');
            $table->foreign('id_trabajador')->references('id_trabajador')->on('trabajadores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impresion_maquina_trabajador');
    }
};