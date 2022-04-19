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
        $expedientes=Tramite::where('resolucion_id',null)->get()->map(function($e){
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
                $resolucion=Resolucione::create([
                    'numero'=>$request->numero,
                    'fecha'=>$request->fecha,
                    'estado'=>1,                        
                ]);
               foreach($request->selected as $tramite_age){
                    //comprovar si el tramite tiene un cosejo
                    $expediente= $tramite_age['id'];
                    $consejoTram=Tramite::where('id',$expediente)->first();
                    if($consejoTram->resolucion_id ==null || $consejoTram->resolucion_id  =='' ){                       
                        //agregar la resolucion a los expedientes
                        Tramite::where('id',$expediente)->update(['resolucion_id'=>$resolucion->id]);
                        
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
            if($e->resolucion_id!=null && $e->resolucion_id!=''){
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
    protected function sg1_resoluciones(){
        
        $agendados['resolucion_grupo']=Resolucione::where('estado',1)->get();
        $agendados['tramites_por_grupo']=Resolucione::where('estado',1)->get()->map(function($a){
            return[
                'resolucion'=>$a->id,
                'resolucion_fecha'=>$a->fecha,
                'resolucion_numero'=>$a->numero,
                'tramite'=>$a->tramite->map(function($e){
                    return[
                        'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                        'id'=> $e->id,
                        'tramite'=>$e->tipo_tramite,
                        'fec_inicio'=>$e-> fec_inicio,
                        'estado'=>$e->estado,
                        'tramite_nombre'=>$e->tipo_tramite,
                    ];
                }),
            ];
        });
        return response()->json($agendados);
        
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
