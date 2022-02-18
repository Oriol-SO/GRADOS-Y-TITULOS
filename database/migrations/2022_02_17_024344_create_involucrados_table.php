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
            $table->id();
            $table->BigInteger('trabajo_id')->unsigned();
            $table->BigInteger('persrol_id')->unsigned();
            $table->BigInteger('rol_id')->unsigned();
            $table->boolean('estado');

            $table->foreign('trabajo_id')->references('id')->on('trabajos');
            $table->foreign('persrol_id')->references('id')->on('persona_roles');
            $table->foreign('rol_id')->references('rol_id')->on('persona_roles');
           
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
