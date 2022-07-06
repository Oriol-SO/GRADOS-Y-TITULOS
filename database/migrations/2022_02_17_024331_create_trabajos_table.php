<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->id();
            $table->string('modo_sustentacion'); 
            $table->string('url_repositorio')->nullable();
            $table->date('fecha_sustentacion')->nullable();
            $table->text('nombre');
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
        Schema::dropIfExists('trabajos');
    }
}
