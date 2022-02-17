<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id('filId');            
            $table->string('path');
            $table->BigInteger('tramId')->unsigned();
            $table->BigInteger('perRolId')->unsigned();
            $table->BigInteger('faseRolReqId')->unsigned();

            $table->foreign('tramId')->references('tramId')->on('tramites');
            $table->foreign('perRolId')->references('perRolId')->on('persona_roles'); 
            $table->foreign('faseRolReqId')->references('faseRolReqId')->on('fase_rol_requisitos');
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
        Schema::dropIfExists('files');
    }
}
