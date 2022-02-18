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
            $table->id();
            $table->BigInteger('rol_id')->unsigned();
            $table->BigInteger('requisito_id')->unsigned();
            $table->BigInteger('fase_id')->unsigned();
          
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->foreign('requisito_id')->references('id')->on('requisitos');
            $table->foreign('fase_id')->references('id')->on('fases');

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
