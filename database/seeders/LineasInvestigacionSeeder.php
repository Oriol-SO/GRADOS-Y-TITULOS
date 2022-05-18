<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LineasInvestigacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('linea_de_investigaciones')->insert([
            //Grados Normales
            [
                'id'=>'1',
                'inveNombre'=>'Tecnologia y telecomunicaciones'
            ],[
                'id'=>'2',
                'inveNombre'=>'gestion empresarial' 
            ],
            [
                'id'=>'3',
                'invNombre'=>'salud mental',
            ],
            [
                'id'=>'4',
                'inveNombre'=>'estregias de aorendizaje'
            ]


            ]);
    }
}
