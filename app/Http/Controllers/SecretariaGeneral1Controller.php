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
use App\Models\PersonaRole;
use App\Models\Proceso;
use App\Models\Denominacion;
use App\Models\Diploma;
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
        $expedientes=Tramite::where('consejo_id',null)/*->where('receptor_rol_notify',3)*/->get()->map(function($e){
                return[
                    'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
                    'id'=> $e->id,
                    'tramite'=>$e->tipo_tramite,
                    //'facultad'=>$e->
                    'fec_inicio'=>$e-> fec_inicio,
                    'estado'=>$e->estado,
                    'tramite'=>$e->tipo_tramite,   
                    'total_fases'=>Fase::where('proceso_id',$e->proceso_id)->count(), 
                    'fase_actual'=>$e->fase_actual, 
                ];
        });
        return response()->json($expedientes,200);
    }
    protected function aprobar_fase_nultiple($tramites){
        foreach($tramites as $tram){
            //comprovar si el tramite tiene un cosejo
            $expediente= $tram['id'];
            $tramite=Tramite::where('id',$expediente)->first();
            $fase_actual=$tramite->fase_actual;                                   
                //actualizar la fase
                Tramite::where('id',$expediente)->update(['fase_actual'=>$fase_actual+1]);
                
            
       }
    }

    protected function aprobar_fase_one($tramite_id){        

            $tramite=Tramite::where('id',$tramite_id)->first();
            $fase_actual=$tramite->fase_actual;                                   
                //actualizar la fase
                Tramite::where('id',$tramite_id)->update(['fase_actual'=>$fase_actual+1]);     

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

               //aprobar fase
               $this->aprobar_fase_nultiple($request->selected);

                
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

            /*$aprobados=Tramite::where('consejo_id','<>',null)->get()->map(function($e){
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

            $apro=Tramite::where('resolucion_id',null)->whereIn('consejo_id',Consejo::where('estado',0)->get('id'))->get()->map(function($e){
                //if($e->consejo->estado==0){
                    return[
                        'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                        'id'=> $e->id,
                        'tramite'=>$e->tipo_tramite,
                        'fec_inicio'=>$e-> fec_inicio,
                        'estado'=>$e->estado,
                        'consejo_numero'=>$e->consejo->numero,
                        'consejo_id'=>$e->consejo->id,
                    ];
              //  }else{ return null}
             
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

                //obtener tramites del consejo
                $tramites=Tramite::where('id',$id)->get();
                $this->aprobar_fase_nultiple($tramites);

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
                        if($resoluTram->resolucion_id == null || $resoluTram->resolucion_id  =='' ){                       
                            //agregar la resolucion a los expedientes
                            if($resoluTram->consejo_id!= null || $resoluTram->consejo_id!= '' ){
                                Tramite::where('id',$expediente)->update(['resolucion_id'=>$resolucion->id]);
                            }
                                                        
                        }
                   }

                    $this->aprobar_fase_nultiple($request->selected);
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

        $tramite_diplomas=Diploma::all()->map(function($e){
            return [$e->tramite_id];
        });
            
 
            $apro=Tramite::where('resolucion_id','<>',null)->whereNotIn('id',$tramite_diplomas)->get()->map(function($e){

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
 
    protected function sg_get_60_campos(Request $request,$id){
        $tramite=Tramite::where('id',$id)->first();
        $persona=Persona::where('id',$tramite->persona_id)->first();
        $personarole=PersonaRole::where('persona_id',$persona->id)->first();
        $proceso=Proceso::where('id',$tramite->proceso_id)->first();
        $grado=Grado::where('id',$proceso->grado_id)->first();
        //$denominacion=Denominacion::where('grado_id',$grado->id)->first();

        $array =[[
                'Nombre'=>'CODUNI',
                'Valor'=>$persona->cod_alum,   
                ],
                [
                'Nombre'=>'RAZ_SOC',
                'Valor'=>'UNIVERSIDAD NACIONAL DANIEL ALCIDES CARRION',   
                ],
                [
                'Nombre'=>'MATRI_FEC',
                'Valor'=>$persona->fec_matri,   
                ],
                [
                'Nombre'=>'FAC_NOM',
                'Valor'=>$personarole->facId,   
                ],
                [
                'Nombre'=>'CARR_PROG',
                'Valor'=>$personarole->escId,   
                ],
                [
                'Nombre'=>'ESC_POS',
                'Valor'=>'',   
                ],
                [
                'Nombre'=>'EGRES_FEC',
                'Valor'=>$persona->fec_egre,   
                ],
                [
                'Nombre'=>'APEPAT',
                'Valor'=>$persona->apePat,   
                ],
                [
                'Nombre'=>'APEMAT',
                'Valor'=>$persona->apeMat,   
                ],
                [
                'Nombre'=>'NOMBRE',
                'Valor'=>$persona->nom,   
                ],
                [
                'Nombre'=>'SEXO',
                'Valor'=>$persona->gen,   
                ],
                [
                'Nombre'=>'DOCU_TIP',
                'Valor'=>$persona->tipDoc,   
                ],
                [
                'Nombre'=>'DOCU_NUM',
                'Valor'=>$persona->numDoc,   
                ],
                [
                'Nombre'=>'PROG_BACH',
                'Valor'=>'',   
                ],
                [
                'Nombre'=>'GRAD_TITU',
                'Valor'=>$persona->grad_estud,   
                ],
                [
                'Nombre'=>'DEN_GRAD',
                'Valor'=>'Falta dato',   
                ],
                [
                'Nombre'=>'SEG_ESP',
                'Valor'=>'',   
                ],
                [
                'Nombre'=>'TRAB_INV',
                'Valor'=>$tramite->trabajo ? $tramite->trabajo->nombre:'',
                ],
                [
                'Nombre'=>'REG_METADATO',
                'Valor'=> $tramite->trabajo ? $tramite->trabajo->url_repositorio:'',
                ],
                [
                'Nombre'=>'MODOBT' ,
                'Valor'=> $tramite->trabajo ? $tramite->trabajo->modo_sustentacion:'',
                ],
                [
                'Nombre'=>'NUM_CRED' ,
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROG_ESTU',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROC_TITULO_PED',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROG_ACREDIT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_INICIO_ACREDIT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_FIN_ACREDIT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_INICIO_MOD_TIT_ACREDIT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_FIN_MOD_TIT_ACREDIT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_SOLICIT_GRAD_TIT',
                'Valor'=>$tramite->fec_inicio,
                ],
                [
                'Nombre'=>'FEC_TRAB_GRAD_TIT' ,
                'Valor'=> '',
                ],
                [
                'Nombre'=>'TRAB_INVEST_ORIGINAL',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'MOD_EST' ,
                'Valor'=> $tramite->modo_obtencion,
                ],
                [
                'Nombre'=>'ABRE_GYT',
                'Valor'=> $grado->graAbr,
                ],
                [
                'Nombre'=>'PROC_REV_PAIS',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROC_REV_UNIV',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROC_REV_GRADO',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'CRIT_REV',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'RESO_NUM',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'RESO_FEC',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'DIPL_FEC_ORG',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'DIPL_FEC_DUP',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'DIPL_TIP_EMI',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'REG_LIBRO',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'REG_FOLIO',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'REG_REGISTRO',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'CARGO1',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'AUTORIDAD1',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'CARGO2',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'AUTORIDAD2',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'CARGO3',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'AUTORIDAD3',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROC_PAIS_EXT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'PROC_GRADO_EXT',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'REG_OFICIO',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_MAT_PROG',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_INICIO_PROG',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'FEC_FIN_PROG',
                'Valor'=> '',
                ],
                [
                'Nombre'=>'MOD_SUSTENTACION',
                'Valor'=> '',
                ],
        ];
        return response($array); 
    }

    protected function enviar_datos_resolucion_internos(Request $request){
        $rol=3;
        $request->validate([
            'folio'=>'required|numeric',
            'libro'=>'required|numeric',
            'registro'=>'required|numeric',
            'tramite_id'=>'required|numeric',
        ]); 
        if($rol==3){
            
                $diploma=Diploma::create([
                    'tramite_id'=>$request->tramite_id,
                    'lib_foli'=>$request->folio,
                    'num_lib'=>$request->libro,
                    'num_lib_regis'=>$request->registro,
                       
                ]);
                
                $this->aprobar_fase_one($request->tramite_id);
                return 'ok';  
       
        }else{
            return 'user no autorizado';
        }
        

    }

    protected function sg1_expe_impresos ($id){
        if($id==0){

        $tramite_diplomas=Diploma::where('est_impreso',1)->where('num_sticker',null)->get()->map(function($e){
            return [$e->tramite_id];
        });
            
 
            $apro=Tramite::where('resolucion_id','<>',null)->whereIn('id',$tramite_diplomas)->get()->map(function($e){
                return[
                    'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                    'id'=> $e->id,
                    'tramite'=>$e->tipo_tramite,
                    'fec_inicio'=>$e-> fec_inicio,
                    'estado'=>$e->estado,
                    'consejo_numero'=>$e->consejo->numero,
                    'consejo_id'=>$e->consejo->id,
                    'diploma'=>$e->diploma->id,                    
                ];
            });
        return response()->json($apro);
        }
    }

    protected function sg1_add_sticker(Request $request){
        $request->validate([
            'sticker'=>'required',
            'tramite_id'=>'required|numeric',
            'diploma_id'=>'required|numeric',

        ]);
        try{       
            Diploma::where('id',$request->diploma_id)->where('tramite_id',$request->tramite_id)->update([
                'num_sticker'=>$request->sticker,
            ]);

            $this->aprobar_fase_one($request->tramite_id);
            return 'agregado';
        }catch(Exception $e){
            return $e;
        }

    }

    protected function sg1_get_sunedu(){  

        $tramite_diplomas=Diploma::where('num_sticker','<>',null)->get()->map(function($e){
            return [$e->tramite_id];
        });

        $consejos=Consejo::where('estado',0)->get()->map(function($a) use(&$tramite_diplomas){
            return [                
                'consejo'=>$a->id,
                'consejo_fecha'=>$a->fecha,
                'consejo_numero'=>$a->numero,
                'tramite'=>Tramite::whereIn('id',$tramite_diplomas)->where('consejo_id',$a->id)->get()->map(function($e){
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
        $for_sunedu=array();
        foreach( $consejos as $tram){
            if(count($tram['tramite'])>0){
                array_push($for_sunedu,$tram);
            }
        }

        return response()->json($for_sunedu,200);
        
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
