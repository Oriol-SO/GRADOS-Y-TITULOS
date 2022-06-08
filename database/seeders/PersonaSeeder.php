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
          'email' => 'secretarias@gmail.com',
          'tipDoc' => '1',
          'numDoc' => '72852802',
          'fecNac' => '1995-12-12',
          'numcel' => '951456894',
          'grad_estud' => 'magister',
          'abre_grad' => 'mgt',
          'cod_alum' => null,
          'curri' => null,
          'espe' => null,
          'fec_matri' => null,
          'fec_egre' => null,
          'proced' => '',
        ],
         
            
            
        ]);
    }
}
