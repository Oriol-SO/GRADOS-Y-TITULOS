<?php

namespace App\Http\Controllers;

use App\Models\Consejo;
use App\Models\Tramite;
use Illuminate\Http\Request;
use App\Models\FaseRolRequisito;
use App\Models\Fase;
use App\Models\Resolucione;


use Exception;

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
    protected function expedientes_aprobados(){
        $consejo=Consejo::where('estado',1)->get()->map(function($c){
            return[
                'consejo_id'=>$c->id,
                'consejo_fecha'=>$c->fecha,
                'consejo_numero'=>$c->numero,
                
                'tramite'=>$c->tramite->map(function($e){
                    return[
                        'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                        'id'=> $e->id,
                        'tramite'=>$e->tipo_tramite,
                        'fec_inicio'=>$e-> fec_inicio,
                        'estado'=>$e->estado,
                        'grado'=>$e->proceso->grado_id,
                    ];
                }),
            ];
        });
        return response()->json($consejo);
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
    protected function sg1_apro_consejo(Request $request){
        $rol=3;
        $request->validate([
            'numero'=>'required|numeric',
            'fecha'=>'required|date',
            'consejo'=>'required',
        ]); 
        if($rol==3){
            try{
                $consejo=Consejo::create([
                    'numero'=>$request->consejo,
                    'fecha'=>$request->fecha,
                    'estado'=>1, 
                    'num_oficio'=>$request->numero,                       
                ]);

                    //obtener datos de los tramites de esta consejo
                    $tramites_consejo=Consejo::where('id',$request->consejo)->get()->map(function($a){
                        return[
                            'tramites'=>$a->tramite->map(function($e){
                                return[         
                                    'id'=> $e->id,
                                    'consejo_id'=>$e->consejo_id,                                
                                ];
                            }),
                        ];
                    });
                    

               foreach($tramites_consejo[0]['tramites'] as $tramite){
                    //comprovar si el tramite tiene un cosejo
                    $expediente= $tramite['id'];
                    $consejoTram=Tramite::where('id',$expediente)->first();
                    if($consejoTram->cosejo_id ==null || $consejoTram->consejo_id  =='' ){                       
                        //agregar la aprobacio a los expedientes
                        Tramite::where('id',$expediente)->update(['consejo_id'=>$consejo->id]);
                        
                    }
               }

               //cambiar el estado de la resolucion

               Consejo::where('id',$request->consejo)->update(['estado'=>0]);

                
            }catch(Exception $e){
                return $e;
            }       
       
        }else{
            return 'user no autorizado';
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
