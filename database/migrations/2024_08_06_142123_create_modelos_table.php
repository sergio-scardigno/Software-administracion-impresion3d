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
        Schema::create('modelos', function (Blueprint $table) {
            $table->id('id_modelo');
            $table->string('nombre');
            $table->decimal('dimension_x', 10, 2);
            $table->decimal('dimension_y', 10, 2);
            $table->decimal('dimension_z', 10, 2);
            $table->integer('horas_estimadas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('modelos');
    }
};