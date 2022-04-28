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


        $apro=Tramite::where('resolucion_id','<>',null,)->get()->map(function($e){
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
}
