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

    protected function sg2_post_imprimir(Request $request){
        $request->validate([
            'tramite_id'=>'required',
            'diploma_id'=>'required',
        ]);
        try{

        $tram_diplo=Diploma::where('id',$request->diploma_id)->where('tramite_id',$request->tramite_id)->update(['est_impreso'=>1]);

        }catch(Exception $e){
            return $e;
        }       

        
    }
}
