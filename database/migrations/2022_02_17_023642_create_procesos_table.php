<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procesos', function (Blueprint $table) {
            $table->id();
            $table->string('procNom');
            $table->BigInteger('grado_id')->unsigned();
            $table->BigInteger('moda_id')->unsigned()->nullable();
            $table->string('tipo');

            $table->foreign('grado_id')->references('id')->on('grados');
            $table->foreign('moda_id')->references('id')->on('modalidades');

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
        Schema::dropIfExists('procesos');
    }
}
