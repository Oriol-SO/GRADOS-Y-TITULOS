<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PersonaRolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('persona_roles')->insert([
            [ //administrador
                'id' => '1',
                'rol_Id' => '13',
                'persona_id' => '1',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>1
            ],
            [ //administrador
                'id' => '2',
                'rol_Id' => '5',
                'persona_id' => '1',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>0
            ],


            [ //Alumno
                'id' => '3',
                'rol_Id' => '10',
                'persona_id' => '2',
                'facId' => '4',
                'escId' => '4SI',
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>1
            ],
           
        ]);

    }
}
