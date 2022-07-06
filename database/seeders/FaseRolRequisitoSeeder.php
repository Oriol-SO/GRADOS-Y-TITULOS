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
        //inic
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
            [
                'id'=>'6',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1006',
            ],
            [
                'id'=>'7',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1007',
            ],
            [
                'id'=>'8',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1008',
            ],
            [
                'id'=>'9',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1009',

            ],
            [
                'id'=>'10',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1010',

            ],
            [
                'id'=>'11',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1011',
            ],
            [
                'id'=>'12',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1012',
            ],
            [
                'id'=>'13',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1013',
            ],
            [
                'id'=>'14',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1014',
            ],
            [
                'id'=>'15',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1015',

            ],
            [
                'id'=>'16',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1016',

            ],
            [
                'id'=>'17',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1017',
            ],
            [
                'id'=>'18',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1018',
            ],
            [
                'id'=>'19',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1019',
            ],
            [
                'id'=>'20',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1020',
            ],
            [
                'id'=>'21',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1021',
            ],
            [
                'id'=>'22',
                'rol_id'=>'10',
                'fase_id' => '101',
                'requisito_id' => '1022',
            ],
            //resolucion de expedito y consejo de facultad
            [                
                'id'=>'23',
                'rol_id'=>'5',
                'fase_id' => '102',
                'requisito_id' => '1023',
            ],
            [
                'id'=>'24',
                'rol_id'=>'5',
                'fase_id' => '102',
                'requisito_id' => '1024',
            ],
            [
                'id'=>'25',
                'rol_id'=>'5',
                'fase_id' => '102',
                'requisito_id' => '1025',
            ],
            //Vicerrectorado
            [
                'id'=>'26',
                'rol_id'=>'11',
                'fase_id' => '103',
                'requisito_id' => '1026',
            ],
        //1 fin bachiller automatico undac 
        
        //4 Inicio Bachiller trabajo undac   
            //requisitos basicos
            [
                'id'=>'27',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1001',
            ],
            [
                'id'=>'28',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1002',
            ],
            [
                'id'=>'29',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1003',
            ],
            [
                'id'=>'30',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1004',
            ],
            [
                'id'=>'31',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1005',
            ],
            [
                'id'=>'32',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1006',
            ],
            [
                'id'=>'33',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1007',
            ],
            [
                'id'=>'34',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1008',
            ],
            [
                'id'=>'35',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1009',
            ],
            [
                'id'=>'36',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1010',
            ],
            [
                'id'=>'37',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1011',
            ],
            [
                'id'=>'38',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1012',
            ],
            [
                'id'=>'39',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1013',
            ],
            [
                'id'=>'40',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1014',
            ],
            [
                'id'=>'41',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1015',
            ],
            [
                'id'=>'42',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1016',
            ],
            [
                'id'=>'43',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1017',
            ],
            [
                'id'=>'44',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1018',
            ],
            [
                'id'=>'45',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1019',
            ],
            [
                'id'=>'46',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1020',
            ],
            [
                'id'=>'47',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1021',
            ],
            [
                'id'=>'48',
                'rol_id'=>'10',
                'fase_id' => '401',
                'requisito_id' => '1022',
            ],
           //resolucion de expedito y consejo de facultad
            [                
                'id'=>'49',
                'rol_id'=>'5',
                'fase_id' => '402',
                'requisito_id' => '1023',
            ],
            [
                'id'=>'50',
                'rol_id'=>'5',
                'fase_id' => '402',
                'requisito_id' => '1024',
            ],
            [
                'id'=>'51',
                'rol_id'=>'5',
                'fase_id' => '402',
                'requisito_id' => '1025',
            ],
            //Vicerrectorado
            [
                'id'=>'52',
                'rol_id'=>'11',
                'fase_id' => '403',
                'requisito_id' => '1026',
            ],
        //4 fin bachiller trabajo undac 
        
        //inicio titulo presencial    
            //solicitudes para inscri
            [
                'id'=>'53',
                'rol_id'=>'10',
                'fase_id' => '1300',
                'requisito_id' => '4001',
            ],
            [
                'id'=>'54',
                'rol_id'=>'10',
                'fase_id' => '1300',
                'requisito_id' => '4002',
            ],
            [
                'id'=>'55',
                'rol_id'=>'10',
                'fase_id' => '1300',
                'requisito_id' => '4003',
            ],
            [
                'id'=>'56',
                'rol_id'=>'10',
                'fase_id' => '1300',
                'requisito_id' => '4004',
            ],
            /*
            [
                'id'=>'57',
                'rol_id'=>'10',
                'fase_id' => '1300',
                'requisito_id' => '5209',
            ],*/
            //'Designación de asesor'
            [
                'id'=>'58',
                'rol_id'=>'5',
                'fase_id' => '1301',
                'requisito_id' => '4005',
            ],
            //'Informe favorable
            [
                'id'=>'59',
                'rol_id'=>'9',
                'fase_id' => '1302',
                'requisito_id' => '5208',
            ],
          
            [
                'id'=>'60',
                'rol_id'=>'9',
                'fase_id' => '1302',
                'requisito_id' => '5209',
            ],  
              //Informe de originalidad        
            [
                'id'=>'61',
                'rol_id'=>'15',
                'fase_id' => '1303',
                'requisito_id' => '4007',
            ],
            //Resolución de inscripción 
            [
                'id'=>'62',
                'rol_id'=>'5',
                'fase_id' => '1304',
                'requisito_id' => '4008',
            ],
         
        //fin titulo automatico

        
        ]);
    }
}
