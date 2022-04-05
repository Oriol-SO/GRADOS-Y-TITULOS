<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado=[
            ['id'=>'1',
             'nombre'=>'Vacio'],
            ['id'=>'2',
             'nombre'=>'Cargado'],
            ['id'=>'3',
             'nombre'=>'Aprobado'],
            ['id'=>'4',
            'nombre'=>'Observado']
           
        ];
        DB::table('estados')->insert($estado);
    }
}
