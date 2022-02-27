<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FaseRolRequisitoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fase_rol_requisitos')->insert([
            [
                'id'=>'1',
                'rol_id'=>'10',
                'requisito_id'=>'1001',
                'fase_id'=>'101',
            ],
            [
                'id'=>'2',
                'rol_id'=>'10',
                'requisito_id'=>'1002',
                'fase_id'=>'101',
            ],
            [
                'id'=>'3',
                'rol_id'=>'10',
                'requisito_id'=>'1003',
                'fase_id'=>'101',
            ],
            [
                'id'=>'4',
                'rol_id'=>'10',
                'requisito_id'=>'1004',
                'fase_id'=>'101',
            ],
            [
                'id'=>'5',
                'rol_id'=>'10',
                'requisito_id'=>'1005',
                'fase_id'=>'101',
            ],
            
            
        ]);
    }
}
