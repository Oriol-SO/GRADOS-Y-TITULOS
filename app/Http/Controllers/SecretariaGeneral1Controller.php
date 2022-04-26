<?php

namespace App\Http\Controllers;

use App\Models\Consejo;
use App\Models\Tramite;
use Illuminate\Http\Request;
use App\Models\FaseRolRequisito;
use App\Models\Fase;
use App\Models\Grado;
use App\Models\Resolucione;
use App\Models\Persona;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class SecretariaGeneral1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expedientes=Tramite::where('consejo_id',null)->get()->map(function($e){
                return[
                    'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
                    'id'=> $e->id,
                    'tramite'=>$e->tipo_tramite,
                    //'facultad'=>$e->
                    'fec_inicio'=>$e-> fec_inicio,
                    'estado'=>$e->estado,
                    'tramite'=>$e->tipo_tramite,    
                ];
        });
        return response()->json($expedientes,200);
    }


    protected function sg1_agendar_expediente(Request $request){
        $rol=3;
        $request->validate([
            'selected'=>'required',
            'numero'=>'required|numeric',
            'fecha'=>'required|date',
        ]); 
        if($rol==3){
            try{
                
                $consejo=Consejo::create([
                    'numero'=>$request->numero,
                    'fecha'=>$request->fecha,
                    'estado'=>1,
                    'num_oficio'=>0,                      
                ]);
               foreach($request->selected as $tramite_age){
                    //comprovar si el tramite tiene un cosejo
                    $expediente= $tramite_age['id'];
                    $consejoTram=Tramite::where('id',$expediente)->first();
                    if($consejoTram->consejo_id ==null || $consejoTram->consejo_id  =='' ){                       
                        //agregar la resolucion a los expedientes
                        Tramite::where('id',$expediente)->update(['consejo_id'=>$consejo->id]);
                        
                    }
               }

                
            }catch(Exception $e){
                return $e;
            }       
       
        }else{
            return 'user no autorizado';
        }
    }
    protected function expedientes_agendados(){
        $agendados=Tramite::all()->map(function($e){
            if($e->consejo_id!=null && $e->consejo_id!=''){
                return[
                'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
                'id'=> $e->id,
                'tramite'=>$e->tipo_tramite,
                'fec_inicio'=>$e-> fec_inicio,
                'estado'=>$e->estado,
                'tramite'=>$e->tipo_tramite,
                ];
            }
         
        });
        return response()->json($agendados);
    }
    protected function expedientes_aprobados($id){
        if($id==0){
          /* $aprobados=DB::table('tramites')
            ->join('consejos', function ($join) {
                $join->on('tramites.consejo_id', '=', 'consejos.id');                    
            })->where('consejos.estado', 1)
            ->get()->map(function($e){
                return[
                    'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                    'id'=> $e->id,
                    'tramite'=>$e->tipo_tramite,
                    'fec_inicio'=>$e-> fec_inicio,
                    'estado'=>$e->estado,
                    'consejo_numero'=>$e->consejo->numero,
                ];
            });*/

             /* $aprobados=Tramite::where('consejo_id','<>',null)->get()->map(function($e){
                if($e->consejo->estado==1){
                    return[
                        'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                        'id'=> $e->id,
                        'tramite'=>$e->tipo_tramite,
                        'fec_inicio'=>$e-> fec_inicio,
                        'estado'=>$e->estado,
                        'consejo_numero'=>$e->consejo->numero,
                    ];
                }

            });*/
            /*$apro=array();
              $aprobados=Consejo::where('estado',0)->get()->map(function($c) use(&$apro){
                $c->tramite->map(function($e) use($c,&$apro){
                        array_push($apro,[
                            'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                            'id'=> $e->id,
                            'tramite'=>$e->tipo_tramite,
                            'fec_inicio'=>$e-> fec_inicio,
                            'estado'=>$e->estado,
                            'consejo_numero'=>$e->consejo->numero,
                         ] );
                    });
                    
              
            });*/

            $apro=Tramite::where('resolucion_id',null)->get()->map(function($e){
                return[
                    'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                    'id'=> $e->id,
                    'tramite'=>$e->tipo_tramite,
                    'fec_inicio'=>$e-> fec_inicio,
                    'estado'=>$e->estado,
                    'consejo_numero'=>$e->consejo->numero,
                    'consejo_id'=>$e->consejo->id,
                ];
            });


           // return $apro;
            return response()->json($apro);
        }else{
        
        }

    }
    protected function sg1_resoluciones(){
        
        $agendados=Consejo::where('estado',1)->get()->map(function($a){
            return[
                'consejo'=>$a->id,
                'consejo_fecha'=>$a->fecha,
                'consejo_numero'=>$a->numero,
                'tramite'=>$a->tramite->map(function($e){
                    return[
                        'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                        'id'=> $e->id,
                        'tramite'=>$e->tipo_tramite,
                        'fec_inicio'=>$e-> fec_inicio,
                        'estado'=>$e->estado,
                    ];
                }),
            ];
        });
        return response()->json($agendados); 
    }
    protected function sg1_apro_consejo(Request $request,$id){
        $rol=3;
        $request->validate([
            'numero'=>'required|numeric',
        ]); 
        if($rol==3){
            try{
                $consejo=Consejo::where('id',$id)->update([
                    'estado'=>0, 
                    'num_oficio'=>$request->numero,                       
                ]);

                    //obtener datos de los tramites de esta consejo
                    /* $tramites_consejo=Consejo::where('id',$request->consejo)->get()->map(function($a){
                        return[
                            'tramites'=>$a->tramite->map(function($e){
                                return[         
                                    'id'=> $e->id,
                                    'consejo_id'=>$e->consejo_id,                                
                                ];
                            }),
                        ];
                    }); */
                    

               /* foreach($tramites_consejo[0]['tramites'] as $tramite){
                    //comprovar si el tramite tiene un cosejo
                    $expediente= $tramite['id'];
                    $consejoTram=Tramite::where('id',$expediente)->first();
                    if($consejoTram->cosejo_id ==null || $consejoTram->consejo_id  =='' ){                       
                        //agregar la aprobacio a los expedientes
                        Tramite::where('id',$expediente)->update(['consejo_id'=>$consejo->id]);
                        
                    }
               } */

               //cambiar el estado de la resolucion

               /* Consejo::where('id',$request->consejo)->update(['estado'=>0]); */

                
            }catch(Exception $e){
                return $e;
            }       
       
        }else{
            return 'user no autorizado';
        }
        

    }
    protected function sg1_apro_resolucion(Request $request){
        $rol=3;
        $request->validate([
            'numero'=>'required|numeric',
            'fecha'=>'required|date',
            'selected'=>'required',
        ]); 
        if($rol==3){
            try{
                $resolucion=Resolucione::create([
                    'numero'=>$request->numero,
                    'fecha'=>$request->fecha,
                    'estado'=>0,                        
                ]);

                    //obtener datos de los tramites de esta consejo
                 
                    foreach($request->selected as $tramite_res){
                        //comprovar si el tramite tiene un cosejo
                        $expediente= $tramite_res['id'];
                        $resoluTram=Tramite::where('id',$expediente)->first();
                        if($resoluTram->resolucion_id ==null || $resoluTram->resolucion_id  =='' ){                       
                            //agregar la resolucion a los expedientes
                            Tramite::where('id',$expediente)->update(['resolucion_id'=>$resolucion->id]);                            
                        }
                   }

               //cambiar el estado del consejo

              // Resolucione::where('id',$request->resolucion)->update(['estado'=>0]);

                
            }catch(Exception $e){
                return $e;
            }       
       
        }else{
            return 'user no autorizado';
        }
        

    }


    protected function sq1_grados(){      
        $todo=[['id'=>'all','graNom'=>'Todo'],['id'=>'1','graNom'=>'Bachiller'],['id'=>'2','graNom'=>'Titulo']];
        return $todo;
    }


    protected function sg1_expe_con_resolucion ($id){
        if($id==0){


        $apro=Tramite::where('resolucion_id','<>',null)->get()->map(function($e){
            return[
                'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                'id'=> $e->id,
                'tramite'=>$e->tipo_tramite,
                'fec_inicio'=>$e-> fec_inicio,
                'estado'=>$e->estado,
                'consejo_numero'=>$e->consejo->numero,
                'consejo_id'=>$e->consejo->id,
            ];
        });
        return response()->json($apro);
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
