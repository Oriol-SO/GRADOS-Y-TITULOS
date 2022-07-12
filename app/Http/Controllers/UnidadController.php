<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\FaseRolRequisito;
use App\Models\File;
use App\Models\Observacione;
use App\Models\Requisito;
use App\Models\Revisione;
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

    public function datos_tramite($id){
        $tramites = tramite::where('id',$id)->get()->map(function($t){
            return[
                'id'=>$t->id,
                'proceso_id'=>$t->proceso_id,
                'tipo_tramite'=>$t->tipo_tramite,
                'fase_actual'=>$t->fase_actual,
                'receptor_rol_notify'=>$t->receptor_rol_notify,
                'trabajo_plan_tesis_url'=>$t->trabajo?$t->trabajo->url_repositorio:null ,
                'titulo_proyecto'=>$t->trabajo?$t->trabajo->nombre:null,
                'integrantes'=>1,
                'grado'=>$t->proceso->grado_id,
                'linea_investigacion'=>$t->trabajo?$t->trabajo->LineaDeInvestigacione->inveNombre:null,
                'sub_linea'=>'default',
            ];
        });
        return response()->json($tramites[0],200);
    }

    public function unidad_fases($id){
        $num=0;
        $fase['fases']=Fase::where('proceso_id', $id)->where(function($query) {
            $query->where('encargado_ejecutar', 15)
                  ->orWhere('encargado_revisar', 15);
        })->orderBy('numero', 'asc')->get()->map(function($f) use(&$num){
            return[
                'id'=>$f->id,
                'nombre'=>$f->nombre,
                'numero'=>$num++,
                'fase_num'=>$f->numero,
            ];
        });
      //  $fase['fases_ejecutar']=Fase::where('proceso_id', $id)->where('encargado_ejecutar',5)->orderBy('numero', 'asc')->oldest()->get();
        $fase['cantidad']=Fase::where('proceso_id', $id)->where(function($query) {
            $query->where('encargado_ejecutar', 15)
                  ->orWhere('encargado_revisar', 15);
        })->get()->count();

        $fase['fases_tramite']=Fase::where('proceso_id',$id)->orderBy('numero', 'asc')->get();
     
        return response()->json($fase);
    }

    public function unidad_requisitos($id, $tramite ){
        $this->tram=$tramite;    

        $rol_sf=15;
        if($rol_sf===15){
                //desabilitar notificacion 
                 //obtener rol revisador 
                $fase_revision=Fase::where('id',$id)->first();
                $revisador=$fase_revision->encargado_revisar;
                $ejecutor=-1;

                if($revisador==15){
                    $ejecutor=$fase_revision->encargado_ejecutar;
                }
                 $tramite_revision=Tramite::where('id',$this->tram)->first();

                 if($tramite_revision->fase_actual!=null){
                        if(5==$tramite_revision->receptor_rol_notify){
                            //eliminar notificacion
                            Tramite::where('id',$this->tram)->update(['receptor_rol_notify'=>null]);
                        }
                    }

            $id_requisito_plan=Requisito::where('tipo_requisito',1)->get('id');
            $requisitos['revisar'] = FaseRolRequisito::where('fase_id',$id)->whereNotIn('requisito_id',$id_requisito_plan)->where('rol_id',$ejecutor)->get()->map(function ($r) {
                return [
                    'id' => $r->id,       
                    'requisito_id' => $r->requisito_id ,
                    'nombre' => $r->requisito ->nombre ,
                    'rol'=> $r->rol->id,
                    'documento'=>$r->requisito->TipoArchivo->tipoNombre,
                    'extension'=>$r->requisito ->tipo_documento,
                    'archivo'=>File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get(),
                    'conforme'=>Revisione::whereIn('file_id',(File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get('id')))->get(),
                    'observacion'=>Observacione::whereIn('file_id',(File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get('id')))->get(),
                    'modificado'=>File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get('num_modifi')->map(function($mod){
                        return $mod->num_modifi;
                    }),   
                  //  'aprovados'=>Revisione::whereIn('file_id',(File::where('tramite_id',$this->tram)->get('id')))->count(),
                    //'observados'=>Observacione::whereIn('file_id',(File::where('tramite_id',$this->tram)->get('id')))->count(),
                ];
            });

            $requisitos['otros']=FaseRolRequisito::where('fase_id',$id)->where('rol_id','<>',$rol_sf)->get()->map(function($o){
                return[
                    'nombre' => $o->requisito ->nombre,
                    'rol' =>$o->rol->rolNombre,
                    'documento'=>$o->requisito->TipoArchivo->tipoNombre,
                    'extension'=>$o->requisito ->tipo_documento, 
                    'archivo_subido'=>File::where('tramite_id',$this->tram)->where('faserolreq_id',$o->id)->get(),
                ];
            });

            $requisitos['aprovados']=0;
            $requisitos['observados']=0;
           foreach ($requisitos['revisar'] as $req) {
               if(count($req['conforme'])>0){
                $requisitos['aprovados']++;
               }elseif(count($req['observacion'])>0){
                $requisitos['observados']++;
               }
           } 
          
         //$requisitos['revisados']=Revisione::where('file_id',)


            $requisitos['propios']=FaseRolRequisito::where('fase_id',$id)->where('rol_id',$rol_sf)->get()->map(function ($r) {
                return [
                    'id' => $r->id,       
                    'requisito_id' => $r->requisito_id ,
                    'nombre' => $r->requisito ->nombre ,
                    'rol'=> $r->rol->id,
                    'documento'=>$r->requisito->TipoArchivo->tipoNombre,
                    'extension'=>   $r->requisito ->tipo_documento,
                    'archivo_subido'=>File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get(),
                    'revisado_aprovado'=>Revisione::whereIn('file_id',(File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get('id')))->get(),
                    'revisado_observado'=>Observacione::whereIn('file_id',(File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get('id')))->get(), 
                    'modificado'=>File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get('num_modifi')->map(function($mod){
                        return $mod->num_modifi;
                    }),                
                ];
            });

            $requisitos['subidosPropios']=0;
            $requisitos['aprovadosPropios']=0;
            $requisitos['observadosPropios']=0;            
           foreach ($requisitos['propios'] as $req){
               if(count($req['revisado_aprovado'])>0){
                $requisitos['aprovadosPropios']++;
               }elseif(count($req['revisado_observado'])>0){
                $requisitos['observadosPropios']++;
               }
               if(count($req['archivo_subido'])>0){
                $requisitos['subidosPropios']++;
               }
           } 
            return response()->json($requisitos);
        }else{
            return 'usuario no autorizado';
        }

    }

}
