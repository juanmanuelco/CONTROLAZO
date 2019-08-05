<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaSalaEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_sala_eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre'); 
            $table->longText('descripcion');
            $table->integer('capacidad')->default(0);
            $table->decimal('precio', 8, 2)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:: dropIfExists('tabla_sala_eventos');
    }
}
