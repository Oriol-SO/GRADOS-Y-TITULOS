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
                'id' => '105',
                'rol_Id' => '13',
                'persona_id' => '1',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
            ],
            [ //rector undac
                'id' => '1',
                'rol_Id' => '1',
                'persona_id' => '2',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
            ], [ //secretaria GEneral Undac uno
                'id' => '2',
                'rol_Id' => '3',
                'persona_id' => '3',
                'facId' => null,
                'escId' => null,
                'fecIni' => '2010-01-01',
                'fecFin' => null,
                'estado' => '1',
            ],[ //secretaria GEneral Undac dos
                'id' => '14',
                'rol_Id' => '12',
                'persona_id' => '14',
                'facId' => null,
                'escId' => null,
                'fecIni' => '2010-01-01',
                'fecFin' => null,
                'estado' => '1',
            ],
            
            [ //vicerrector de undac
                'id' => '3',
                'rol_Id' => '2',
                'persona_id' => '13',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
            ], [ //Secretaria vicerrector de undac
                'id' => '13',
                'rol_Id' => '9',
                'persona_id' => '105',
                'facId' => null,
                'escId' => null,
                'fecIni' => null,
                'fecFin' => null,
                'estado' => '1',
            ],
           
        ]);

    }
}
