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
            $table->id();            
            $table->string('path');
            $table->BigInteger('tramite_id')->unsigned();
            $table->BigInteger('persrol_id')->unsigned();
            $table->BigInteger('faserolreq_id')->unsigned();

            $table->foreign('tramite_id')->references('id')->on('tramites');
            $table->foreign('persrol_id')->references('id')->on('persona_roles'); 
            $table->foreign('faserolreq_id')->references('id')->on('fase_rol_requisitos');
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
