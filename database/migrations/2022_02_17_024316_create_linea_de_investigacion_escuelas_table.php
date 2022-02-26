<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineaDeInvestigacionEscuelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linea_de_investigacion_escuelas', function (Blueprint $table) {
                $table->id();
                $table->string('escuela_id');
                $table->BigInteger('lineainv_id')->unsigned();

                $table->foreign('lineainv_id')->references('id')->on('linea_de_investigaciones');
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
        Schema::dropIfExists('linea_de_investigacion_escuelas');
    }
}
