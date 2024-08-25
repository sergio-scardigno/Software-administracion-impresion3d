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
            Schema::create('maquinas', function (Blueprint $table) {
                $table->id('id_maquina');
                $table->string('nombre');
                $table->date('fecha_compra');
                $table->integer('vida_util_anios');
                $table->decimal('costo', 10, 2);
                $table->integer('intervalo_servicio_horas');

                // Costo del Service de mantenimiento
                $table->decimal('costo_servicio', 10, 2);

                // Nuevas columnas
                $table->decimal('costo_energia_por_hora', 10, 2);
                $table->decimal('costo_mantenimiento_por_hora', 10, 2);
                $table->integer('horas_utilizadas')->nullable();
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('maquinas');
        }
};