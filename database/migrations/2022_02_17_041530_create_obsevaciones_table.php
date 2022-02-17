<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObsevacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obsevaciones', function (Blueprint $table) {
            $table->id('obserId');
            $table->BigInteger('filId')->unsigned();
            $table->BigInteger('perRolId')->unsigned();
            $table->text('texto');

            $table->foreign('filId')->references('filId')->on('files');
            $table->foreign('perRolId')->references('perRolId')->on('files');            
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
        Schema::dropIfExists('obsevaciones');
    }
}
