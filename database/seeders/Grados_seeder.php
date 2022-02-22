<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class Grados_seeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('grados')->insert([
            //Grados Normales
            ['id'=>1,'graNom'=>'BACHILLER','graAbr'=>'B','nivel'=>'posgrado'],
            ['id'=>2,'graNom'=>'TITULO','graAbr'=>'T','nivel'=>'posgrado'],
            ['id'=>3,'graNom'=>'MAESTRO','graAbr'=>'M','nivel'=>'posgrado'],
            ['id'=>4,'graNom'=>'DOCTOR','graAbr'=>'D','nivel'=>'posgrado'],
            ['id'=>5,'graNom'=>'TITULO DE SEGUNDA ESPECIALIDAD','graAbr'=>'S','nivel'=>'posgrado'],
            //Otros tramites
            ['id'=>6,'graNom'=>'DOCUMENTOS PREGRADO','graAbr'=>'O','nivel'=>'pregrado']
            ]);
    }
}
