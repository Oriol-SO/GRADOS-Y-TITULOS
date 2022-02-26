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
                'id' => '1',
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
              
            ],
            [
                'id' => '2',
                'nom' => 'secretaria general uno undac',
                'apePat' => 'apellido1',
                'apeMat' => 'apellido2',
                'gen' => '1',
                'dom' => 'Jr test2',
                'email' => 'secGenUno@gmail.com',
                'tipDoc' => '1',
                'numDoc' => '400000002',
                'fecNac' => '1995-12-12',
                'grad_estud' => 'magister',
                'abre_grad' => 'mgt',
                'cod_alum' => '',
                'curri' => '',
                'espe' => '',
              // 'fec_matri' => '',
              // 'fec_egre' => '',
                'proced' => '',
                'numCel' => '987654321'
            ],
            [
                'id' => '14',
                'nom' => 'secretaria general dos undac',
                'apePat' => 'apellido1',
                'apeMat' => 'apellido2',
                'gen' => '1',
                'dom' => 'Jr test2',
                'email' => 'secGenDos@gmail.com',
                'tipDoc' => '1',
                'numDoc' => '40000003',
                'fecNac' => '1995-12-12',
                'grad_estud' => 'magister',
                'abre_grad' => 'mgt',
                'cod_alum' => '',
                'curri' => '',
                'espe' => '',
              // 'fec_matri' => '',
              // 'fec_egre' => '',
                'proced' => '',
                'numCel' => '987654321'
            ], [
                'id' => '3',
                'nom' => 'nombre vice rector undac',
                'apePat' => 'apellido1',
                'apeMat' => 'apellido2',
                'gen' => '1',
                'dom' => 'Jr test2',
                'email' => 'vicRec@gmail.com',
                'tipDoc' => '1',
                'numDoc' => '40000004',
                'fecNac' => '1995-12-12',
                'grad_estud' => 'magister',
                'abre_grad' => 'mgt',
                'cod_alum' => '',
                'curri' => '',
                'espe' => '',
              // 'fec_matri' => '',
              // 'fec_egre' => '',
                'proced' => '',
                'numCel' => '987654321'
            ], 

            [
                'id' => '13',
                'nom' => 'nombre secretaria vice rector undac',
                'apePat' => 'apellido1',
                'apeMat' => 'apellido2',
                'gen' => '1',
                'dom' => 'Jr test2',
                'email' => 'secVicRec@gmail.com',
                'tipDoc' => '1',
                'numDoc' => '40000013',
                'fecNac' => '1995-12-12',
                'grad_estud' => 'magister',
                'abre_grad' => 'mgt',
                'cod_alum' => '',
                'curri' => '',
                'espe' => '',
              // 'fec_matri' => '',
              // 'fec_egre' => '',
                'proced' => '',
                'numCel' => '987654321'
            ],
           
            
            [
                'id' => '105',
                'nom' => 'administrador1',
                'apePat' => 'apellido1',
                'apeMat' => 'apellido2',
                'gen' => '1',
                'dom' => 'Jr test2',
                'email' => 'admin1@gmail.com',
                'tipDoc' => '1',
                'numDoc' => '40000020',
                'fecNac' => '1995-12-14',
                'grad_estud' => 'magister',
                'abre_grad' => 'mgt',
                'cod_alum' => '',
                'curri' => '',
                'espe' => '',
              // 'fec_matri' => '',
              // 'fec_egre' => '',
                'proced' => '',
                'numCel' => '987654323'
            ],
        ]);
    }
}
