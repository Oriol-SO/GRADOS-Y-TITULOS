<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('apePat');
            $table->string('apeMat');
            $table->boolean('gen');
            $table->string('dom')->nullable();
            $table->string('email')->unique();
            $table->integer('tipDoc');
            $table->string('numDoc');
            $table->date('fecNac')->nullable();
            $table->string('numcel')->nullable();
            $table->string('grad_estud')->nullable();
            $table->string('abre_grad')->nullable();
            $table->string('cod_alum',10)->nullable();
            $table->string('curri')->nullable();
            $table->string('facu')->nullable();
            $table->string('espe')->nullable();
            $table->string('fec_matri')->nullable();
            $table->string('fec_egre')->nullable();
            $table->string('proced')->nullable();
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
        Schema::dropIfExists('personas');
    }
}
