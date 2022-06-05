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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SecretariaGeneral2Controller extends Controller
{
    protected function sg2_expedientes_aprobados($id){
        if($id==0){
            $apro=array();
              $aprobados=Consejo::where('estado',0)->get()->map(function($c) use(&$apro){
                array_push($apro,[
                'consejo'=>$c->id,
                'consejo_fecha'=>$c->fecha,
                'consejo_numero'=>$c->numero,
                'tramite'=>$c->tramite->map(function($e)use($c,&$apro){
                    return[
                        'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                        'id'=> $e->id,
                        'tramite'=>$e->tipo_tramite,
                        'fec_inicio'=>$e-> fec_inicio,
                        'estado'=>$e->estado,
                            ];
                        }),
                        ] );
                    });

                       
            return response()->json($apro);
        }else{
        
        }

    }
    protected function sg2_get_imprimir ($id){
        if($id==0){

            $tramite_diplomas=Diploma::all()->map(function($e){
                return [$e->tramite_id];
            });
        $apro=Tramite::where('resolucion_id','<>',null,)->whereIn('id',$tramite_diplomas)->get()->map(function($e){
                return[
                'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,           
                'id'=> $e->id,
                'tramite'=>$e->tipo_tramite,
                'fec_inicio'=>$e-> fec_inicio,
                'estado'=>$e->estado,
                'consejo_numero'=>$e->consejo->numero,
                'consejo_id'=>$e->consejo->id,
                'diploma'=>$e->diploma->id,
                'estado_impri'=>$e->diploma->est_impreso,
            ];
        });
        return response()->json($apro);
        }
    }
    protected function aprobar_fase_one($tramite_id){        

        $tramite=Tramite::where('id',$tramite_id)->first();
        $fase_actual=$tramite->fase_actual;                                   
            //actualizar la fase
            Tramite::where('id',$tramite_id)->update(['fase_actual'=>$fase_actual+1]);     

    }

    protected function sg2_post_imprimir(Request $request){
        $request->validate([
            'tramite_id'=>'required',
            'diploma_id'=>'required',
        ]);
        try{
            //verificar que no tenga impresiones 
        $impresion=(Diploma::where('id',$request->diploma_id)->where('tramite_id',$request->tramite_id)->first())->est_impreso;
        if($impresion!=1){
            Diploma::where('id',$request->diploma_id)->where('tramite_id',$request->tramite_id)->update(['est_impreso'=>1]);
            $this->aprobar_fase_one($request->tramite_id);
        }else{
            return 'ya esta impreso';
        }   
        }catch(Exception $e){
            return $e;
        }        
    }
    protected function sg2_get_programar($id){
        if($id==0){
            $tramite_diplomas=Diploma::where('num_sticker','<>',null)->get()->map(function($e){
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
                'estado_impri'=>$e->diploma->est_impreso,
                'fecha_entrega'=>$e->diploma->fec_hor_entre,
            ];
        });
        return response()->json($apro);
        }
    }
    protected function sg2_add_fecha_entrega(Request $request){
        $request->validate([
            'fecha'=>'required',
            'diploma_id'=>'required|numeric',
            'tramite_id'=>'required|numeric',
        ]);

             //actualizar
            //verificar que no haya fecha y hora
            $fec_hor_entre=(Diploma::where('id',$request->diploma_id)->where('tramite_id',$request->tramite_id)->first())->fec_hor_entre;
            if($fec_hor_entre=='' || $fec_hor_entre==null){
                $fech_hora=Diploma::where('tramite_id',$request->tramite_id)->where('id',$request->diploma_id)
                ->update(['fec_hor_entre'=>$request->fecha]);
                $this->aprobar_fase_one($request->tramite_id);
                return $fech_hora;
                
            }else{
                $fech_hora=Diploma::where('tramite_id',$request->tramite_id)->where('id',$request->diploma_id)
                ->update(['fec_hor_entre'=>$request->fecha]);
                return $fech_hora;
            }
            //
           
    }
    protected function sg2_get_programados($id){
        if($id==0){

            $today = Carbon::now();            
            $fecha = Carbon::parse($today);
            $mfecha = $fecha->month;
            $dfecha = $fecha->day;
            $afecha = $fecha->year;
           // return $afecha.'/'.$mfecha.'/'.$dfecha;
            //$fecha_hoy= date("Y-m-d",strtotime($fecha_entrega[0]));
            $tramite_diplomas=Diploma::where('num_sticker','<>',null)
            ->whereYear('fec_hor_entre', $afecha)
            ->whereMonth('fec_hor_entre', $mfecha)
            ->whereDay('fec_hor_entre', $dfecha)            
            ->get()->map(function($e){
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
                'estado_impri'=>$e->diploma->est_impreso,
                'hora'=>date("H:i A",strtotime($e->diploma->fec_hor_entre)),

            ];
        });
        return response()->json($apro);
        }
    }
    protected function sg2_entregar($id, Request $request){
        $request->validate([
            'entregar'=>'required',
            'tramite_id'=>'required'
        ]);
        if($id==$request->tramite_id){
           //entrgar tramite y cambiar estado de 0 a 1
           Tramite::where('id',$id)->update(['estado'=>1 , 'fase_actual'=>12]);
           return 'OK';
        }
    }
    
}

