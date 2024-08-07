<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('impresiones', function (Blueprint $table) {
            $table->id('id_impresion');
            $table->unsignedBigInteger('id_maquina');
            $table->unsignedBigInteger('id_trabajador');
            $table->dateTime('fecha_inicio');
            $table->dateTime('fecha_fin')->nullable();
            $table->integer('horas_impresion');
            $table->decimal('dimension_x', 10, 2);
            $table->decimal('dimension_y', 10, 2);
            $table->decimal('dimension_z', 10, 2);
            $table->timestamps();

            $table->foreign('id_maquina')->references('id_maquina')->on('maquinas')->onDelete('cascade');
            $table->foreign('id_trabajador')->references('id_trabajador')->on('trabajadores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('impresiones');
    }
};