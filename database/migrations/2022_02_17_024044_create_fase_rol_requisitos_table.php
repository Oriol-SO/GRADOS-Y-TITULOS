<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaseRolRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fase_rol_requisitos', function (Blueprint $table) {
            $table->id('faseRolReqId');
            $table->BigInteger('rolId')->unsigned();
            $table->BigInteger('reqId')->unsigned();
            $table->BigInteger('faseId')->unsigned();
          
            $table->foreign('rolId')->references('rolId')->on('roles');
            $table->foreign('reqId')->references('reqId')->on('requisitos');
            $table->foreign('faseId')->references('faseId')->on('fases');

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
        Schema::dropIfExists('fase_rol_requisitos');
    }
}
