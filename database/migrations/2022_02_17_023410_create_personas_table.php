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
            $table->id('perId');
            $table->string('nom');
            $table->string('apePat');
            $table->string('apeMat');
            $table->boolean('gen');
            $table->string('dom');
            $table->string('email');
            $table->integer('tipDoc');
            $table->string('numDoc');
            $table->date('fecNac');
            $table->string('numcel',9);
            $table->string('grad_esud');
            $table->string('abre_grad');
            $table->string('cod_alum',10)->nullable();
            $table->string('curri')->nullable();
            $table->string('espe')->nullable();
            $table->date('fec_matri')->nullable();
            $table->date('fec_egre')->nullable();
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
