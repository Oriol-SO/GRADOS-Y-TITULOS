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
                $table->id();
                $table->BigInteger('tramite_id')->unsigned();
                $table->string('num_lib');
                $table->string('num_lib_regis');
                $table->integer('lib_foli');
                $table->string('num_sticker');
                $table->timestamp('fec_hor_entre')->nullable();
                $table->string('num_info_vice');
                $table->boolean('est_impreso')->default(0);

                $table->foreign('tramite_id')->references('id')->on('tramites');
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
