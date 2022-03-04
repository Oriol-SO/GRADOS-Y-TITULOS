<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BachillerFinal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tablafinals')->insert([
            [
                'id'=>'1',
                'Mes'=>'Enero',
                'Finalizados'=>'8',
                'Bini_id'=>'10'
            ],
            [
                'id'=>'2',
                'Mes'=>'Febrero',
                'Finalizados'=>'23',
                'Bini_id'=>'11'
            ],
            [
                'id'=>'3',
                'Mes'=>'Marzo',
                'Finalizados'=>'21',
                'Bini_id'=>'12'
            ],
            [
                'id'=>'4',
                'Mes'=>'Abril',
                'Finalizados'=>'45',
                'Bini_id'=>'1'
            ],
            [
                'id'=>'5',
                'Mes'=>'Mayo',
                'Finalizados'=>'20',
                'Bini_id'=>'2'
            ],
            [
                'id'=>'6',
                'Mes'=>'Junio',
                'Finalizados'=>'15',
                'Bini_id'=>'3'
            ],
            [
                'id'=>'7',
                'Mes'=>'Julio',
                'Finalizados'=>'30',
                'Bini_id'=>'4'
            ],
            [
                'id'=>'8',
                'Mes'=>'Agosto',
                'Finalizados'=>'12',
                'Bini_id'=>'5'
            ],
            [
                'id'=>'9',
                'Mes'=>'Septiembre',
                'Finalizados'=>'40',
                'Bini_id'=>'6'
            ],
            [
                'id'=>'10',
                'Mes'=>'Octubre',
                'Finalizados'=>'4',
                'Bini_id'=>'7'
            ],
            [
                'id'=>'11',
                'Mes'=>'Noviembre',
                'Finalizados'=>'39',
                'Bini_id'=>'8'
            ],
            [
                'id'=>'12',
                'Mes'=>'Diciembre',
                'Finalizados'=>'35',
                'Bini_id'=>'9'
            ],  
        ]);
    }
}
