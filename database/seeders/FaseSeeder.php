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
                
              
            
                   
                       
                       
                  ]);
    }
}
