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
            $table->id();
            $table->BigInteger('file_id')->unsigned();
            $table->BigInteger('persrol_id')->unsigned();
            $table->text('texto');

            $table->foreign('file_id')->references('id')->on('files');
            $table->foreign('persrol_id')->references('persrol_id')->on('files');            
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
