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
                         
                    ],
                    [
                        'id' => '102',
                        'proceso_id' => '1',  
                        'nombre' => 'Expedito y aprobacion de Consejo de Facultad',//Resolucion de expedito, resolucion de consejo de facultad
                        'numero' => '2',
                        'fase_id'=>'102',
                        
                    ],
                    [
                        'id' => '103',
                        'proceso_id' => '1',  
                        'nombre' => 'En vicerrectorado',
                        'numero' => '3',
                        'fase_id'=>'103',
                         
                    ],
                    [
                        'id' => '104',
                        'proceso_id' => '1',  
                        'nombre' => 'Para Agendar',
                        'numero' => '4',
                        'fase_id'=>'104',
                        
                    ],
                    [
                        'id' => '105',
                        'proceso_id' => '1',  
                        'nombre' => 'Agendados',//número de consejo universitario y fecha de consejo
                        'numero' => '5',
                        'fase_id'=>'105',
                        
                    ],
                    [
                        'id' => '106',
                        'proceso_id' => '1',  
                        'nombre' => 'Aprobados',//número de Oficio y confirmar fecha y cu
                        'numero' => '6',
                        'fase_id'=>'106',
                         
                    ],
                    [
                        'id' => '107',
                        'proceso_id' => '1',  
                        'nombre' => 'En control interno',//numero de Resolucion
                        'numero' => '7',
                        'fase_id'=>'107',
                         
                    ],
                    [
                        'id' => '108',
                        'proceso_id' => '1',  
                        'nombre' => 'En impresión',//requiere 60 campos mas datos internos
                        'numero' => '8',
                        'fase_id'=>'108',
                         
                    ],
                    [
                        'id' => '109',
                        'proceso_id' => '1',  
                        'nombre' => 'En control de sticker',//requiere dar clik en diploma impreso 
                        'numero' => '9',
                        'fase_id'=>'109',
                         
                    ],
                    [
                        'id' => '110',
                        'proceso_id' => '1',  
                        'nombre' => 'Listo para programar entrega y madar a sunedu',//requiere numero de stiker
                        'numero' => '10',
                        'fase_id'=>'110',
                         
                    ],
                    [
                        'id' => '111',
                        'proceso_id' => '1',  
                        'nombre' => 'Programados',
                        'numero' => '11',
                        'fase_id'=>'111',
                        
                    ],
                    [
                        'id' => '112',
                        'proceso_id' => '1',  
                        'nombre' => 'Finalizados',
                        'numero' => '12',
                        'fase_id'=>'112',
                        
                    ],
                    
                //1 Fin Bachiller Automatico 
                
                //2 Inicio Bachiller Semi presencial Automatico
                    [
                        'id' => '201',
                        'proceso_id' => '2',  
                        'nombre' => 'Cargando Requisitos Basicos',
                        'numero' => '1',
                        'fase_id'=>'201',
                         
                    ],
                    [
                        'id' => '202',
                        'proceso_id' => '2',  
                        'nombre' => 'Expedito y aprobacion de Consejo de Facultad',//Resolucion de expedito, resolucion de consejo de facultad
                        'numero' => '2',
                        'fase_id'=>'202',
                        
                    ],
                    [
                        'id' => '203',
                        'proceso_id' => '2',  
                        'nombre' => 'En vicerrectorado',//oficio
                        'numero' => '3',
                        'fase_id'=>'203',
                        
                    ],
                    [
                        'id' => '204',
                        'proceso_id' => '2',  
                        'nombre' => 'Para Agendar',
                        'numero' => '4',
                        'fase_id'=>'204',
                         
                    ],
                    [
                        'id' => '205',
                        'proceso_id' => '2',  
                        'nombre' => 'Agendados',//número de consejo universitario y fecha de consejo
                        'numero' => '5',
                        'fase_id'=>'205',
                         
                    ],
                    [
                        'id' => '206',
                        'proceso_id' => '2',  
                        'nombre' => 'Aprobados',//número de Oficio y confirmar fecha y cu
                        'numero' => '6',
                        'fase_id'=>'206',
                         
                    ],
                    [
                        'id' => '207',
                        'proceso_id' => '2',  
                        'nombre' => 'En control interno',//numero de Resolucion
                        'numero' => '7',
                        'fase_id'=>'207',
                         
                    ],
                    [
                        'id' => '208',
                        'proceso_id' => '2',  
                        'nombre' => 'En impresión',//requiere 60 campos mas datos internos
                        'numero' => '8',
                        'fase_id'=>'208',
                       
                    ],
                    [
                        'id' => '209',
                        'proceso_id' => '2',  
                        'nombre' => 'En control de sticker',//requiere dar clik en diploma impreso 
                        'numero' => '9',
                        'fase_id'=>'209',
                         
                    ],
                    [
                        'id' => '210',
                        'proceso_id' => '2',  
                        'nombre' => 'Listo para programar entrega y madar a sunedu',//requiere numero de stiker
                        'numero' => '10',
                        'fase_id'=>'210',
                         
                    ],
                    [
                        'id' => '211',
                        'proceso_id' => '2',  
                        'nombre' => 'Programados',
                        'numero' => '11',
                        'fase_id'=>'211',
                        
                    ],
                    [
                        'id' => '212',
                        'proceso_id' => '2',  
                        'nombre' => 'Finalizados',
                        'numero' => '12',
                        'fase_id'=>'212',
                        
                    ],
            
                    //2 Fin Bachiller Semi Presencial Automatico 
            
                   
                       
                       
                  ]);
    }
}
