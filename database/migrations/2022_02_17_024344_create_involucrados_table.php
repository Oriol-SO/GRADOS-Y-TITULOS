<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvolucradosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('involucrados', function (Blueprint $table) {
            $table->id('involId');
            $table->BigInteger('trabId')->unsigned();
            $table->BigInteger('perRolId')->unsigned();
            $table->BigInteger('rolId')->unsigned();
            $table->boolean('estado');

            $table->foreign('trabId')->references('trabId')->on('trabajos');
            $table->foreign('perRolId')->references('perRolId')->on('persona_roles');
            $table->foreign('rolId')->references('rolId')->on('persona_roles');
           
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
        Schema::dropIfExists('involucrados');
    }
}
