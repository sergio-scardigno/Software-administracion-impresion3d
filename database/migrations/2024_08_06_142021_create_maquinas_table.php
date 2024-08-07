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
                $table->decimal('costo_servicio', 10, 2);
                $table->timestamps();
            });
        }
    
        public function down()
        {
            Schema::dropIfExists('maquinas');
        }
};