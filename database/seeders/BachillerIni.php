<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BachillerIni extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tablainicios')->insert([
            [
                'id'=>'1',
                'Mes'=>'Enero',
                'Iniciados'=>'10'
            ],
            [
                'id'=>'2',
                'Mes'=>'Febrero',
                'Iniciados'=>'23'
            ],
            [
                'id'=>'3',
                'Mes'=>'Marzo',
                'Iniciados'=>'20'
            ],
            [
                'id'=>'4',
                'Mes'=>'Abril',
                'Iniciados'=>'43'
            ],
            [
                'id'=>'5',
                'Mes'=>'Mayo',
                'Iniciados'=>'26'
            ],
            [
                'id'=>'6',
                'Mes'=>'Junio',
                'Iniciados'=>'12'
            ],
            [
                'id'=>'7',
                'Mes'=>'Julio',
                'Iniciados'=>'28'
            ],
            [
                'id'=>'8',
                'Mes'=>'Agosto',
                'Iniciados'=>'15'
            ],
            [
                'id'=>'9',
                'Mes'=>'Septiembre',
                'Iniciados'=>'34'
            ],
            [
                'id'=>'10',
                'Mes'=>'Octubre',
                'Iniciados'=>'10'
            ],
            [
                'id'=>'11',
                'Mes'=>'Noviembre',
                'Iniciados'=>'38'
            ],
            [
                'id'=>'12',
                'Mes'=>'Diciembre',
                'Iniciados'=>'27'
            ],  
        ]);
    }
}
