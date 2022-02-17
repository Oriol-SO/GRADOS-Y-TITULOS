<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTramitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tramites', function (Blueprint $table) {

            $table->id('tramId');
            $table->date('fec-inicio');
            $table->date('fec-fin')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('modo_obtencion')->nullable();
            $table->string('tipo_tramite');
            $table->integer('fase_actual');
            $table->boolean('estado');

            $table->BigInteger('trabId')->unsigned();
            $table->BigInteger('perId')->unsigned();
            $table->BigInteger('procId')->unsigned();
            $table->BigInteger('consId')->unsigned()->nullable();
            $table->BigInteger('resolId')->unsigned()->nullable();

            $table->foreign('trabId')->references('trabId')->on('trabajos');
            $table->foreign('perId')->references('perId')->on('personas');
            $table->foreign('procId')->references('procId')->on('procesos');
            $table->foreign('consId')->references('consId')->on('consejos');
            $table->foreign('resolId')->references('resolId')->on('resoluciones');
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
        Schema::dropIfExists('tramites');
    }
}
