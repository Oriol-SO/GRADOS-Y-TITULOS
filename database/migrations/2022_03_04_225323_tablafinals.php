<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class tablafinals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tablafinals', function (Blueprint $table) {
            $table->id();
            $table->string('Mes');
            $table->integer('Finalizados')->nullable();
            $table->bigInteger('Bini_id')->unsigned();

            $table->foreign('Bini_id')->references('id')->on('tablainicios');
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
        Schema::dropIfExists('tablafinals');
    }
}
