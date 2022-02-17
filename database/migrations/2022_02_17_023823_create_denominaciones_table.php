<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenominacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denominaciones', function (Blueprint $table) {
            $table->id('denoId');
            $table->string('nombre');
            $table->string('especialidad_id'); //obtenemos de la api
            $table->BigInteger('graId')->unsigned();
            $table->foreign('graid')->references('graId')->on('grados');
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
        Schema::dropIfExists('denominaciones');
    }
}
