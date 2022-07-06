<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Proceso_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('procesos')->insert([
            //Porcesos principales
            ['id' => 1,  'procNom' => 'BACHILLER PRESENCIAL AUTOMATICO UNDAC', 'grado_id' => 1, 'moda_id' => 1, 'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 2,  'procNom' => 'BACHILLER SEMI PRESENCIAL AUTOMATICO UNDAC', 'grado_id' => 1, 'moda_id' => 2,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 3,  'procNom' => 'BACHILLER A DISTANCIA AUTOMATICO UNDAC', 'grado_id' => 1, 'moda_id' => 3,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 4,  'procNom' => 'BACHILLER PRESENCIAL TRABAJO UNDAC', 'grado_id' => 1, 'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 5,  'procNom' => 'BACHILLER SEMI PRESENCIAL TRABAJO UNDAC', 'grado_id' => 1, 'moda_id' => 2,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 6,  'procNom' => 'BACHILLER A DISTANCIA TRABAJO UNDAC', 'grado_id' => 1, 'moda_id' => 3,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 7,  'procNom' => 'BACHILLER PRESENCIAL AUTOMATICO OTRAS UNIVERSIDADES', 'grado_id' => 1,'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 8,  'procNom' => 'BACHILLER SEMI PRESENCIAL AUTOMATICO OTRAS UNIVERSIDADESC', 'grado_id' => 1,'moda_id' => 2,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 9,  'procNom' => 'BACHILLER A DISTANCIA AUTOMATICO OTRAS UNIVERSIDADES', 'grado_id' => 1,'moda_id' => 3,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 10, 'procNom' => 'BACHILLER PRESENCIAL TRABAJO OTRAS UNIVERSIDADES', 'grado_id' => 1,'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 11, 'procNom' => 'BACHILLER SEMI PRESENCIAL TRABAJO OTRAS UNIVERSIDADES', 'grado_id' => 1, 'moda_id' => 2,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 12, 'procNom' => 'BACHILLER A DISTANCIA TRABAJO OTRAS UNIVERSIDADES', 'grado_id' => 1, 'moda_id' => 3,'tipo' => '1','estado'=>0,'guardado'=>0],

            ['id' => 13, 'procNom' => 'TITULO PRESENCIAL UNDAC', 'grado_id' => 2, 'moda_id' => 1,'tipo' => '1','estado'=>1,'guardado'=>1],
            ['id' => 14, 'procNom' => 'TITULO SEMI PRESENCIAL UNDAC', 'grado_id' => 2, 'moda_id' => 2,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 15, 'procNom' => 'TITULO A DISTANCIA UNDAC', 'grado_id' => 2, 'moda_id' => 3,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 16, 'procNom' => 'TITULO PRESENCIAL OTRAS UNIVERSIDADES', 'grado_id' => 2, 'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 17, 'procNom' => 'TITULO SEMI PRESENCIAL OTRAS UNIVERSIDADES', 'grado_id' => 2, 'moda_id' => 2,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 18, 'procNom' => 'TITULO A DISTANCIA OTRAS UNIVERSIDADES', 'grado_id' => 2, 'moda_id' => 3,'tipo' => '1','estado'=>0,'guardado'=>0],

            ['id' => 19, 'procNom' => 'MAESTRIA', 'grado_id' => 3, 'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 20, 'procNom' => 'DOCTORADO', 'grado_id' => 4, 'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],
            ['id' => 21, 'procNom' => 'SEGUNDA ESPECIALIDAD', 'grado_id' => 5, 'moda_id' => 1,'tipo' => '1','estado'=>0,'guardado'=>0],

            //procesos segundarios
            ['id' => 100, 'procNom' => 'CONSTANCIA DE PRIMERA MATRICULA', 'grado_id' => 6, 'moda_id' => null,'tipo' => '2','estado'=>0,'guardado'=>0],
            ['id' => 101, 'procNom' => 'CERTIFICADO DE ESTUDIOS', 'grado_id' => 6, 'moda_id' => null,'tipo' => '2','estado'=>0,'guardado'=>0],

        ]);
    }
}
