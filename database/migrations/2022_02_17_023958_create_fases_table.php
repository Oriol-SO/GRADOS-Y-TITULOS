<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fases', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->integer('numero');
            $table->bigInteger('fase_id')->unsigned()->nullable();
            $table->BigInteger('proceso_id')->unsigned();
            $table->bigInteger('encargado_ejecutar');
            $table->bigInteger('encargado_revisar');

            $table->foreign('proceso_id')->references('id')->on('procesos');
            // $table->foreign('fase_id')->references('id')->on('fases');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fases');
    }
}
