<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaReservaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_reservaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTimeTz('fecha_hora_inicio'); 
            $table->dateTimeTz('fecha_hora_final'); 
            $table->text('reservante');
            $table->text('cedula');
            $table->dateTimeTz('fecha_hora_reservacion'); 
            $table->boolean('pagado');

            $table->integer('sala')->unsigned();
            $table->foreign('sala')->references('id')->on('tabla_sala_eventos');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:: dropIfExists('tabla_reservaciones');
    }
}
