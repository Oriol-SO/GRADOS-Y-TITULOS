<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Modalidad_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modalidades')->insert([
            ['id'=>1,'modNombre'=>'PRESENCIAL','modAbre'=>'P'],
            ['id'=>2,'modNombre'=>'SEMI PRESENCIAL','modAbre'=>'S'],
            ['id'=>3,'modNombre'=>'A DISTANCIA','modAbre'=>'D']
            ]);
    }
}
