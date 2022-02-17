<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requisitos', function (Blueprint $table) {
            $table->id('reqId');
            $table->string('nombre');
            $table->string('tipo_documento');
            $table->text('html_formato')->nullable();
            $table->BigInteger('tipoId')->unsigned();

            $table->foreign('tipoId')->references('tipoId')->on('tipo_archivos');
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
        Schema::dropIfExists('requisitos');
    }
}
