<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonaRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persona_roles', function (Blueprint $table) {
            $table->id('perRolId');
            $table->date('fecIni');
            $table->date('fecFin')->nullable();
            $table->boolean('estado');
            $table->BigInteger('perId')->unsigned(); 
            $table->string('facId'); //se obtendra de la api
            $table->string('escId');//se obtendra de la api
            $table->BigInteger('rolId')->unsigned();
           
           
            $table->foreign('perId')->references('perId')->on('personas');
            $table->foreign('rolId')->references('rolId')->on('roles');
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
        Schema::dropIfExists('persona_roles');
    }
}
