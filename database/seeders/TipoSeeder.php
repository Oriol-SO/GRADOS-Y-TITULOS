<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_archivos')->insert([
            [
                'id'=>'1',
                'tipoNombre' => 'FUT',
                                          
            ],
            [
                'id'=>'2',
                'tipoNombre' => 'Voucher',
                                       
            ],
            [
                'id'=>'3',
                'tipoNombre' => 'Constancia o certificado',
                                          
            ],
            [
                'id'=>'4',
                'tipoNombre' => 'Copia',
                                         
            ],
            [
                'id'=>'5',
                'tipoNombre' => 'Documento original',
                 
            ],
            [
                'id'=>'6',
                'tipoNombre' => 'Fotografias',
                
            ],
            [
                'id'=>'7',
                'tipoNombre' => 'Resolución',
                 
            ],
            [
                'id'=>'8',
                'tipoNombre' => 'DVD',
                 
            ],
            [
                'id'=>'9',
                'tipoNombre' => 'Oficio',
                 
            ],
            [
                'id'=>'10',
                'tipoNombre' => 'Informe',
                 
            ],
            [
                'id'=>'11',
                'tipoNombre' => 'Detalles',
                 
            ]
            ]
        
        );
    }
}
