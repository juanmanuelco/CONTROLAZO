<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TablaMesAportacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tabla_mes_aportacion', function (Blueprint $table) {
            $table->unsignedBigInteger('c_codigo')->primary();
            $table->integer('aportante')->unsigned();

            $table->year('anual');
            $table->integer('mensual');
            $table->timestamps();
            $table->decimal('valor', 8, 2);
            $table->decimal('aporte', 8, 2);
            $table->decimal('ahorro', 8, 2)->default(0);
            $table->enum('estado', [ 'NORMAL', 'SOBREGIRO', 'CUBRE SOBREGIRO']);

            $table->foreign('aportante')->references('id')->on('tabla_aportantes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema:: dropIfExists('tabla_mes_aportacion');
    }
}
