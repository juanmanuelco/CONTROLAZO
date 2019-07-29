<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaAportantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_aportantes', function (Blueprint $table) {
            $table->increments('id');
            $table->text('nombre'); 
            $table->enum('proceso', [ 'NOMINA']);
            $table->text('cedula');
            $table->decimal('sueldo', 8, 2)->default(0);
            $table->enum('tipo', [ 'APORTANTE', 'SOCIO']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:: dropIfExists('tabla_aportantes');
    }
}
