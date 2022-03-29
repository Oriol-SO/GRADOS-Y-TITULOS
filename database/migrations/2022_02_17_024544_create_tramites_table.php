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

            $table->id();
            $table->date('fec-inicio');
            $table->date('fec-fin')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->string('modo_obtencion')->nullable();
            $table->string('tipo_tramite');
            $table->integer('fase_actual');
            $table->boolean('estado');

            $table->BigInteger('trabajo_id')->unsigned()->nullable();
            $table->BigInteger('persona_id')->unsigned()->nullable();
            $table->BigInteger('proceso_id')->unsigned()->nullable();
            $table->BigInteger('consejo_id')->unsigned()->nullable();
            $table->BigInteger('resolucion_id')->unsigned()->nullable();

            $table->foreign('trabajo_id')->references('id')->on('trabajos');
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('proceso_id')->references('id')->on('procesos');
            $table->foreign('consejo_id')->references('id')->on('consejos');
            $table->foreign('resolucion_id')->references('id')->on('resoluciones');
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
