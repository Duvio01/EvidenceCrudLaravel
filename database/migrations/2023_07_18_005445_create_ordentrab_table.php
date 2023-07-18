<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordentrab', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_creacion');
            $table->date('fecha_asignacion')->nullable();
            $table->date('fecha_ejecucion')->nullable();
            $table->unsignedBigInteger('id_tipo')->nullable();
            $table->unsignedBigInteger('id_operador')->nullable();
            $table->longText('descripcion')->nullable();
            $table->decimal('valor', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('id_tipo')->references('id')->on('tipo_orden');
            $table->foreign('id_operador')->references('id')->on('operadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordentrab');
    }
};
