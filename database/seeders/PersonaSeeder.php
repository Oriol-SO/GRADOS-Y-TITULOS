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
            'nom' => 'Daniel',
            'apePat' => 'Alcides',
            'apeMat' => 'Carrion',
            'gen' => '1',
            'dom' => 'Jr test2',
            'email' => 'admin@gmail.com',
            'tipDoc' => '1',
            'numDoc' => '72852801',
            'fecNac' => '1995-12-12',
            'numcel' => '951456894',
            'grad_estud' => 'magister',
            'abre_grad' => 'mgt',
            'cod_alum' => '',
            'curri' => '',
            'espe' => '',
            'facu'=>null,
            'fec_matri' => '',
            'fec_egre' => '',
            'proced' => '',
          
        ],
        [
          'id' => '2',
          'nom' => 'Jose',
          'apePat' => 'Perez',
          'apeMat' => 'Espinoza',
          'gen' => '1',
          'dom' => 'Jr test2',
          'email' => 'secretaria@gmail.com',
          'tipDoc' => '1',
          'numDoc' => '72852802',
          'fecNac' => '1995-12-12',
          'numcel' => '951456894',
          'grad_estud' => 'magister',
          'abre_grad' => 'mgt',
          'cod_alum' => null,
          'curri' => null,
          'espe' => null,
          'facu'=>null,
          'fec_matri' => null,
          'fec_egre' => null,
          'proced' => '',
        ],
        [
          'id' => '3',
          'nom' => 'Jorge',
          'apePat' => 'Perez',
          'apeMat' => 'Basadre',
          'gen' => '1',
          'dom' => 'Jr test2',
          'email' => 'asesor@gmail.com',
          'tipDoc' => '1',
          'numDoc' => '72852801',
          'fecNac' => '1995-12-12',
          'numcel' => '951456894',
          'grad_estud' => 'magister',
          'abre_grad' => 'mgt',
          'cod_alum' => null,
          'curri' => null,
          'espe' => null,
          'facu'=>null,
          'fec_matri' => null,
          'fec_egre' => null,
          'proced' => '',
          
        ],
        [
          'id' => '4',
          'nom' => 'Oriol',
          'apePat' => 'Simon',
          'apeMat' => 'Orneta',
          'gen' => '1',
          'dom' => 'Jr test2',
          'email' => 'alumno@gmail.com',
          'tipDoc' => '1',
          'numDoc' => '72852802',
          'fecNac' => '1995-12-12',
          'numcel' => '951456894',
          'grad_estud' => 'bachiller',
          'abre_grad' => 'mgt',
          'cod_alum' => '1824403021',
          'curri' => '18A12',
          'espe' => '4SI',
          'facu'=>'4',
          'fec_matri' => '2018',
          'fec_egre' => '2022',
          'proced' => '',
        ],
        [
          'id' => '5',
          'nom' => 'Pit',
          'apePat' => 'Alania',
          'apeMat' => 'Ricaldi',
          'gen' => '1',
          'dom' => 'Jr test2',
          'email' => 'unidad@gmail.com',
          'tipDoc' => '1',
          'numDoc' => '72852805',
          'fecNac' => '1995-12-12',
          'numcel' => '951456894',
          'grad_estud' => 'magister',
          'abre_grad' => 'mgt',
          'cod_alum' => '',
          'curri' => '',
          'espe' => '',
          'facu'=>'',
          'fec_matri' => '',
          'fec_egre' => '',
          'proced' => '',
        ],        
            
            
        ]);
    }
}
