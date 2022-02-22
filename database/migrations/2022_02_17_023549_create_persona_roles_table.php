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
            $table->id();
            $table->date('fecIni')->nullable();
            $table->date('fecFin')->nullable();
            $table->boolean('estado');
            $table->BigInteger('persona_id')->unsigned(); 
            $table->string('facId')->nullable(); //se obtendra de la api
            $table->string('escId')->nullable();//se obtendra de la api
            $table->BigInteger('rol_id')->unsigned();
           
           
            $table->foreign('persona_id')->references('id')->on('personas');
            $table->foreign('rol_id')->references('id')->on('roles');
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
