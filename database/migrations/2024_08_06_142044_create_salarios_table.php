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
        Schema::create('salarios', function (Blueprint $table) {
            $table->id(); // Esta es la clave primaria
            $table->string('tipo_trabajador');
            $table->decimal('salario_mensual', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('salarios');
    }
};