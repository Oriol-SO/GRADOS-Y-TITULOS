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


            [ //secretarias facultad
                'id' => '2',
                'rol_Id' => '5',
                'persona_id' => '2',
                'facId' => '4',
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>1
            ],
            [ //secretarias viderrect
                'id' => '3',
                'rol_Id' => '11',
                'persona_id' => '2',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>0
            ],
            [ //secretarias general1
                'id' => '4',
                'rol_Id' => '3',
                'persona_id' => '2',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>0
            ],
            [ //secretarias general2
                'id' => '5',
                'rol_Id' => '12',
                'persona_id' => '2',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
                'uso'=>0
            ],

           
        ]);

    }
}
