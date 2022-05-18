<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class FaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fases')->insert([
            //Inicio Procesos Generales
                //INICIO BACHILLER    
                    //1 Inicio Bachiller Automatico
                    [
                        'id' => '101',
                        'proceso_id' => '1',  
                        'nombre' => 'Cargando Requisitos Basicos',
                        'numero' => '1',
                        'fase_id'=>'101',
                        'encargado_ejecutar'=>'10',
                        'encargado_revisar'=>'5'
                    ],
                    [
                        'id' => '102',
                        'proceso_id' => '1',  
                        'nombre' => 'Expedito y aprobacion de Consejo de Facultad',//Resolucion de expedito, resolucion de consejo de facultad
                        'numero' => '2',
                        'fase_id'=>'102',
                        'encargado_ejecutar'=>'5',
                        'encargado_revisar'=>'11'
                        
                    ],
                    [
                        'id' => '103',
                        'proceso_id' => '1',  
                        'nombre' => 'En vicerrectorado',
                        'numero' => '3',
                        'fase_id'=>'103',
                        'encargado_ejecutar'=>'11',
                        'encargado_revisar'=>'3'
                         
                    ],
                    [
                        'id' => '104',
                        'proceso_id' => '1',  
                        'nombre' => 'Para Agendar',
                        'numero' => '4',
                        'fase_id'=>'104',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                        
                    ],
                    [
                        'id' => '105',
                        'proceso_id' => '1',  
                        'nombre' => 'Agendados',//número de consejo universitario y fecha de consejo
                        'numero' => '5',
                        'fase_id'=>'105',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                        
                    ],
                    [
                        'id' => '106',
                        'proceso_id' => '1',  
                        'nombre' => 'Aprobados',//número de Oficio y confirmar fecha y cu
                        'numero' => '6',
                        'fase_id'=>'106',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                         
                    ],
                    [
                        'id' => '107',
                        'proceso_id' => '1',  
                        'nombre' => 'En control interno',//numero de Resolucion
                        'numero' => '7',
                        'fase_id'=>'107',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                    ],
                    [
                        'id' => '108',
                        'proceso_id' => '1',  
                        'nombre' => 'En impresión',//requiere 60 campos mas datos internos
                        'numero' => '8',
                        'fase_id'=>'108',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                    ],
                    [
                        'id' => '109',
                        'proceso_id' => '1',  
                        'nombre' => 'En control de sticker',//requiere dar clik en diploma impreso 
                        'numero' => '9',
                        'fase_id'=>'109',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                         
                    ],
                    [
                        'id' => '110',
                        'proceso_id' => '1',  
                        'nombre' => 'Listo para programar entrega y madar a sunedu',//requiere numero de stiker
                        'numero' => '10',
                        'fase_id'=>'110',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                         
                    ],
                    [
                        'id' => '111',
                        'proceso_id' => '1',  
                        'nombre' => 'Programados',
                        'numero' => '11',
                        'fase_id'=>'111',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                    ],
                    [
                        'id' => '112',
                        'proceso_id' => '1',  
                        'nombre' => 'Finalizados',
                        'numero' => '12',
                        'fase_id'=>'112',
                        'encargado_ejecutar'=>'3',
                        'encargado_revisar'=>'3'
                        
                    ],
                    
                //1 Fin Bachiller Automatico 
                //2 Inicio Bachiller Semi presencial Automatico
            [

                'id' => '201',
                'proceso_id' => '2',  
                'nombre' => 'Cargando Requisitos Basicos',
                'numero' => '1',
                'fase_id'=>'201',
                'encargado_revisar'=>'5',
                'encargado_ejecutar'=>'10'
            ],
            [
                'id' => '202',
                'proceso_id' => '2',  
                'nombre' => 'Expedito y aprobacion de Consejo de Facultad',//Resolucion de expedito, resolucion de consejo de facultad
                'numero' => '2',
                'fase_id'=>'202',
                'encargado_revisar'=>'11',
                'encargado_ejecutar'=>'5'
            ],
            [
                'id' => '203',
                'proceso_id' => '2',  
                'nombre' => 'En vicerrectorado',//oficio
                'numero' => '3',
                'fase_id'=>'203',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'11'
            ],
            [
                'id' => '204',
                'proceso_id' => '2',  
                'nombre' => 'Para Agendar',
                'numero' => '4',
                'fase_id'=>'204',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '205',
                'proceso_id' => '2',  
                'nombre' => 'Agendados',//número de consejo universitario y fecha de consejo
                'numero' => '5',
                'fase_id'=>'205',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '206',
                'proceso_id' => '2',  
                'nombre' => 'Aprobados',//número de Oficio y confirmar fecha y cu
                'numero' => '6',
                'fase_id'=>'206',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '207',
                'proceso_id' => '2',  
                'nombre' => 'En control interno',//numero de Resolucion
                'numero' => '7',
                'fase_id'=>'207',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '208',
                'proceso_id' => '2',  
                'nombre' => 'En impresión',//requiere 60 campos mas datos internos
                'numero' => '8',
                'fase_id'=>'208',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'12'
            ],
            [
                'id' => '209',
                'proceso_id' => '2',  
                'nombre' => 'En control de sticker',//requiere dar clik en diploma impreso 
                'numero' => '9',
                'fase_id'=>'209',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '210',
                'proceso_id' => '2',  
                'nombre' => 'Listo para programar entrega y madar a sunedu',//requiere numero de stiker
                'numero' => '10',
                'fase_id'=>'210',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'12'
            ],
            [
                'id' => '211',
                'proceso_id' => '2',  
                'nombre' => 'Programados',
                'numero' => '11',
                'fase_id'=>'211',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'12'
            ],
            [
                'id' => '212',
                'proceso_id' => '2',  
                'nombre' => 'Finalizados',
                'numero' => '12',
                'fase_id'=>'212',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],

        //2 Fin Bachiller Semi Presencial Automatico 







        //4 Inicio BACHILLER PRESENCIAL TRABAJO UNDAC
            [
                'id' => '401',
                'proceso_id' => '4',  
                'nombre' => 'Cargando Requisitos Basicos',
                'numero' => '1',
                'fase_id'=>'401',
                'encargado_revisar'=>'5',
                'encargado_ejecutar'=>'10'
            ],
            [
                'id' => '402',
                'proceso_id' => '4',  
                'nombre' => 'Expedito y aprobacion de Consejo de Facultad',//Resolucion de expedito, resolucion de consejo de facultad
                'numero' => '2',
                'fase_id'=>'402',
                'encargado_revisar'=>'11',
                'encargado_ejecutar'=>'5'
            ],
            [
                'id' => '403',
                'proceso_id' => '4',  
                'nombre' => 'En vicerrectorado',//oficio
                'numero' => '3',
                'fase_id'=>'403',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'11'
            ],
            [
                'id' => '404',
                'proceso_id' => '4',  
                'nombre' => 'Para Agendar',
                'numero' => '4',
                'fase_id'=>'404',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '405',
                'proceso_id' => '4',  
                'nombre' => 'Agendados',//número de consejo universitario y fecha de consejo
                'numero' => '5',
                'fase_id'=>'405',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '406',
                'proceso_id' => '4',  
                'nombre' => 'Aprobados',//número de Oficio y confirmar fecha y cu
                'numero' => '6',
                'fase_id'=>'406',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '407',
                'proceso_id' => '4',  
                'nombre' => 'En control interno',//numero de Resolucion
                'numero' => '7',
                'fase_id'=>'407',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '408',
                'proceso_id' => '4',  
                'nombre' => 'En impresión',//requiere 60 campos mas datos internos
                'numero' => '8',
                'fase_id'=>'408',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'12'
            ],
            [
                'id' => '409',
                'proceso_id' => '4',  
                'nombre' => 'En control de sticker',//requiere dar clik en diploma impreso 
                'numero' => '9',
                'fase_id'=>'409',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],
            [
                'id' => '410',
                'proceso_id' => '4',  
                'nombre' => 'Listo para programar entrega y madar a sunedu',//requiere numero de stiker
                'numero' => '10',
                'fase_id'=>'410',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'12'
            ],
            [
                'id' => '411',
                'proceso_id' => '4',  
                'nombre' => 'Programados',
                'numero' => '11',
                'fase_id'=>'411',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'12'
            ],
            [
                'id' => '412',
                'proceso_id' => '4',  
                'nombre' => 'Finalizados',
                'numero' => '12',
                'fase_id'=>'412',
                'encargado_revisar'=>'3',
                'encargado_ejecutar'=>'3'
            ],

        //4 fin BACHILLER PRESENCIAL TRABAJO UNDAC 

    //FIN BACHILLER
    //INICIO TITULO
        //13 inicio Titulo presencial
        [
            'id' => '1301',
            'proceso_id' => '13',  
            'nombre' => 'solicitudes para inscripción de proyecto y designación de asesor',
            'numero' => '1',
            'fase_id' => '1301',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1302',
            'proceso_id' => '13',  
            'nombre' => 'Designación de asesor',//Resoluciones
            'numero' => '2',
            'fase_id' => '1302',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'5'//sec Fac
        ],
        [
            'id' => '1303',
            'proceso_id' => '13',  
            'nombre' => 'Informe de originalidad',//Asesor//Resoluciones
            'numero' => '3',
            'fase_id' => '1303',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'9'//Asesor
        ],
        [
            'id' => '1304',
            'proceso_id' => '13',  
            'nombre' => 'Resolución de inscripción de tesis',//secretaria de facultad//Resoluciones
            'numero' => '4',
            'fase_id' => '1304',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'5'//sec Fac
        ],
        [
            'id' => '1305',
            'proceso_id' => '13',  
            'nombre' => 'Solicitud de aprobación de investigación',//Fut
            'numero' => '5',
            'fase_id' => '1305',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1306',
            'proceso_id' => '13',  
            'nombre' => 'Informe aprobatorio(Borrador de tesis)',
            'numero' => '6',
            'fase_id' => '1306',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'9'//Asesor
        ],
        [
            'id' => '1307',
            'proceso_id' => '13',  
            'nombre' => 'Solicitud para nombramiento de jurados',
            'numero' => '7',
            'fase_id' => '1307',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1308',
            'proceso_id' => '13',  
            'nombre' => 'Nombramiento de jurados',//Resolución
            'numero' => '8',
            'fase_id' => '1308',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'5'//sec Fac
        ],
        [
            'id' => '1309',
            'proceso_id' => '13',  
            'nombre' => 'Informe de jurados',//Informe
            'numero' => '9',
            'fase_id' => '1309',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'8'//jurados
        ],
        [
            'id' => '1310',
            'proceso_id' => '13',  
            'nombre' => 'Cargando solicitud para aprobación de tesis',//número de resolución y fecha
            'numero' => '10',
            'fase_id' => '1310',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1311',
            'proceso_id' => '13',  
            'nombre' => 'Revision de tesis Aprobación',//resolucion de aprobacion de tesis
            'numero' => '11',
            'fase_id' => '1311',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'5'//secretaria de facultad
        ],
        [
            'id' => '1312',
            'proceso_id' => '13',  
            'nombre' => 'Solicitud para ser declarado expedito y completar requisitos',
            'numero' => '12',
            'fase_id' => '1312',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1313',
            'proceso_id' => '13',  
            'nombre' => 'Expediente para expedito',//Resolución de expedito si aprobado
            'numero' => '13',
            'fase_id' => '1313',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'5'//secretaria de facultad
        ],
        [
            'id' => '1314',
            'proceso_id' => '13',  
            'nombre' => 'Solicitud de fecha y hora de sustentación',//fut
            'numero' => '14',
            'fase_id' => '1314',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1315',
            'proceso_id' => '13',  
            'nombre' => 'Programación de fecha y hora de sustentación',//Oficio
            'numero' => '15',
            'fase_id' => '1315',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'5'//secretaria de Facultad
        ],
        [
            'id' => '1316',
            'proceso_id' => '13',  
            'nombre' => 'Solicitud para aprobación de título profesional por consejo de facultad',
            'numero' => '16',
            'fase_id' => '1316',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '1317',
            'proceso_id' => '13',  
            'nombre' => 'Revisión en consejo de facultad',//Resolución
            'numero' => '17',
            'fase_id' => '1317',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'12'//secGen
        ],
        [
            'id' => '1318',
            'proceso_id' => '13',  
            'nombre' => 'En vicerrectorado',//oficio
            'numero' => '18',
            'fase_id' => '1318',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'12'
        ],
        [
            'id' => '1319',
            'proceso_id' => '13',  
            'nombre' => 'Para Agendar',
            'numero' => '19',
            'fase_id' => '1319',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'3'
        ],
        [
            'id' => '1320',
            'proceso_id' => '13',  
            'nombre' => 'Agendados',//número de consejo universitario y fecha de consejo
            'numero' => '20',
            'fase_id' => '1320',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'3'
        ],
        [
            'id' => '1321',
            'proceso_id' => '13',  
            'nombre' => 'Aprobados',//número de Oficio y confirmar fecha y cu
            'numero' => '21',
            'fase_id' => '1321',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'3'
        ],
        [
            'id' => '1322',
            'proceso_id' => '13',  
            'nombre' => 'En control interno',//numero de Resolucion
            'numero' => '22',
            'fase_id' => '1322',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'3'
        ],
        [
            'id' => '1323',
            'proceso_id' => '13',  
            'nombre' => 'En impresión',//requiere 60 campos mas datos internos
            'numero' => '23',
            'fase_id' => '1323',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'12'
        ],
        [
            'id' => '1324',
            'proceso_id' => '13',  
            'nombre' => 'En control de sticker',//requiere dar clik en diploma impreso 
            'numero' => '24',
            'fase_id' => '1324',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'3'
        ],
        [
            'id' => '1325',
            'proceso_id' => '13',  
            'nombre' => 'Listo para programar entrega y madar a sunedu',//requiere numero de stiker
            'numero' => '25',
            'fase_id' => '1325',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'12'
        ],
        [
            'id' => '1326',
            'proceso_id' => '13',  
            'nombre' => 'Programados',
            'numero' => '26',
            'fase_id' => '1326',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'12'
        ],
        [
            'id' => '1327',
            'proceso_id' => '13',  
            'nombre' => 'Finalizados',
            'numero' => '27',
            'fase_id' => '1327',
            'encargado_revisar'=>'12',
            'encargado_ejecutar'=>'3'
        ],
    //13 fin Titulo presencial      

    
    //Inicio Procesos Segundarios
        //20inicio Contancia de Primera Matricula
        [
            'id' => '2001',
            'proceso_id' => '100',  
            'nombre' => 'Cargando Requisitos Basicos',
            'numero' => '1',
            'fase_id' => '2001',
            'encargado_revisar'=>'5',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '2002',
            'proceso_id' => '100',  
            'nombre' => 'Entrega de Constancia',
            'numero' => '2',
            'fase_id' => '2002',
            'encargado_revisar'=>'14',
            'encargado_ejecutar'=>'14'//jefe de registros academicos
        ],
        //20fin Constancia de Primera Matricula
        //21inicio Certificado de Estudios
        [
            'id' => '2101',
            'proceso_id' => '101',  
            'nombre' => 'Cargando Requisitos Basicos',
            'numero' => '1',
            'fase_id' => '2101',
            'encargado_revisar'=>'5',
            'encargado_ejecutar'=>'10'//alumno
        ],
        [
            'id' => '2102',
            'proceso_id' => '101',  
            'nombre' => 'Entrega de Certificado',
            'numero' => '2',
            'fase_id' => '2102',
            'encargado_revisar'=>'14',
            'encargado_ejecutar'=>'14'//jefe de registros academicos
        ],
        //21fin Certificado de Estudios

    //Fin Procesos Segundarios
                  ]);
    }
}
