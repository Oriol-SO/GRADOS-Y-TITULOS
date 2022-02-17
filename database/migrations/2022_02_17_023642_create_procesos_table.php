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
            $table->id('procId');
            $table->string('procNom');
            $table->BigInteger('graId')->unsigned();
            $table->BigInteger('modId')->unsigned();
            $table->string('tipo');

            $table->foreign('graId')->references('graId')->on('grados');
            $table->foreign('modId')->references('modId')->on('modalidades');

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
