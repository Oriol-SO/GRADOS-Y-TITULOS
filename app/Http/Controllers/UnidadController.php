<?php

namespace App\Http\Controllers;

use App\Models\Trabajo;
use App\Models\Tramite;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    
    public function expedientes(){
        $trabajos=Trabajo::where('url_repositorio','<>',null)->where('visto_bueno_plan',1)->get('id');
        $expedientes=Tramite::whereIn('trabajo_id',$trabajos)->get()->map(function($e){
            return[
                'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
               //'per_apepat'=>$e->persona->apePat,
                //'per_apemat'=>$e->persona->apeMat,
                'id'=> $e->id,
                'tramite'=>$e->tipo_tramite,
                //'facultad'=>$e->
                'fec_inicio'=>$e-> fec_inicio,
                //'estado'=>$e->estado,
                'tramite'=>$e->tipo_tramite,
                //'fase_actual'=>$e->fase_actual,
                'notificacion'=>$e->receptor_rol_notify==15? true:false,
            ];
        });
        return $expedientes;
    }
}
