<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personas')->insert([
            [
                'perId' => '1',
                'nom' => 'nombre rector undac',
                'apePat' => 'apellido1',
                'apeMat' => 'apellido2',
                'gen' => '1',
                'dom' => 'Jr test2',
                'email' => 'admin@gmail.com',
                'tipDoc' => '1',
                'numDoc' => '40000001',
                'fecNac' => '1995-12-12',
                'numcel' => '951456894',
                'grad_estud' => 'magister',
                'abre_grad' => 'mgt',
                'cod_alum' => '',
                'curri' => '',
                'espe' => '',
              // 'fec_matri' => '',
              // 'fec_egre' => '',
                'proced' => '',
              
            ]
        ]);
    }
}
