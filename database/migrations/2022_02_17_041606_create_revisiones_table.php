<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRevisionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('revisiones', function (Blueprint $table) {
            $table->id('revId');
            $table->BigInteger('filId')->unsigned();
            $table->BigInteger('perRolId')->unsigned();
            $table->BigInteger('estaId')->unsigned();
            $table->boolean('estado');

            $table->foreign('filId')->references('filId')->on('files');
            $table->foreign('perRolId')->references('perRolId')->on('persona_roles');
            $table->foreign('estaId')->references('estaId')->on('estados');
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
        Schema::dropIfExists('revisiones');
    }
}
