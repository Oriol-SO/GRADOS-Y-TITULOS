<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiplomasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diplomas', function (Blueprint $table) {
                $table->id('dipId');
                $table->BigInteger('tramId')->unsigned();
                $table->string('num_lib');
                $table->string('num_lib_regis');
                $table->integer('lib_foli');
                $table->string('num_sticker');
                $table->date('fec_hor_entre')->nullable();
                $table->string('num_info_vice');

                $table->foreign('tramId')->references('tramId')->on('tramites');
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
        Schema::dropIfExists('diplomas');
    }
}