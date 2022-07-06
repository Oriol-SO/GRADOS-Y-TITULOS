<?php

namespace App\Http\Controllers;

use App\Models\Fase;
use App\Models\FaseRolRequisito;
use App\Models\File;
use App\Models\Involucrado;
use App\Models\Observacione;
use App\Models\Persona;
use App\Models\PersonaRole;
use App\Models\Proceso;
use App\Models\Revisione;
use App\Models\Tramite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsesorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    protected function asesor_expedientes(Request $request){
        $user=($request->user())->persona_id;

        $persona_roles=PersonaRole::where('persona_id',$user)->where('rol_id',9)->get('id');
        $trabajos=Involucrado::whereIn('persrol_id',$persona_roles)->get('trabajo_id');


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
                'notificacion'=>$e->receptor_rol_notify==5? true:false,
            ];
        });

        return $expedientes;
        
    }

    protected function tramite_asesor($id){
        
        $tramites = tramite::where('id',$id)->get()->map(function($t){
            return[
                'id'=>$t->id,
                'proceso_id'=>$t->proceso_id,
                'tipo_tramite'=>$t->tipo_tramite,
                'fase_actual'=>$t->fase_actual,
                'receptor_rol_notify'=>$t->receptor_rol_notify,
                'trabajo_plan_tesis_url'=>'',//$t->trabajo?$t->trabajo->url_repositorio:null ,
                'titulo_proyecto'=>$t->trabajo?$t->trabajo->nombre:null,
                'integrantes'=>1,
                'grado'=>$t->proceso->grado_id,
                'linea_investigacion'=>$t->trabajo?$t->trabajo->LineaDeInvestigacione->inveNombre:null,
            ];
        });
        return response()->json($tramites[0],200);
    }

    public function asesor_fases_tramite($id){
        $num=0;
        $fase['fases']=Fase::where('proceso_id', $id)->where(function($query) {
            $query->where('encargado_ejecutar', 9)
                  ->orWhere('encargado_revisar', 9);
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
            $query->where('encargado_ejecutar', 9)
                  ->orWhere('encargado_revisar', 9);
        })->get()->count();

        $fase['fases_tramite']=Fase::where('proceso_id',$id)->orderBy('numero', 'asc')->get();
     
        return response()->json($fase);
    }

    public function asesor_requisito($id, $tramite ){
        $this->tram=$tramite;    

        $rol_sf=9;
        if($rol_sf===9){
                //desabilitar notificacion 
                 //obtener rol revisador 
                // $fase_revision=Fase::where('id',$id)->first();
                // $revisador=$fase_revision->encargado_revisar;
                 $tramite_revision=Tramite::where('id',$this->tram)->first();

                 if($tramite_revision->fase_actual!=null){
                        if(5==$tramite_revision->receptor_rol_notify){
                            //eliminar notificacion
                            Tramite::where('id',$this->tram)->update(['receptor_rol_notify'=>null]);
                        }
                    }


            $requisitos['alumno'] = FaseRolRequisito::where('fase_id',$id)->where('rol_id',10)->get()->map(function ($r) {
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
            $requisitos['aprovados']=0;
            $requisitos['observados']=0;
           foreach ($requisitos['alumno'] as $req) {
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

     public function asesor_subirequisito(Request $request){
        $rol=9;
        if($rol===9){
                       
            $user=$request->user();
            // $persona=$user->persona_id;
            $personarol=(PersonaRole::where('persona_id',$user->persona_id)->where('uso',1)->where('estado',1)->first())->id;
            $request->validate([
                'archivo'=>'required'
            ]);

            //actualizar

            //subir nuevo
            //verificar que no haya archivos de este requisito
            $file_req=File::where('tramite_id',$request->tramite)->where('faserolreq_id',$request->idfaserequi)->count();
            if($file_req>0){                
                //actualizar
                $file=File::where('tramite_id',$request->tramite)->where('faserolreq_id',$request->idfaserequi)->first();
                                
                    //borramos el archivo de la carpeta
                      $url_borrar=str_replace('storage','public',$file->path);
                       Storage::delete($url_borrar);
                    //subimos la nueva ruta                    
                        $new_url=Storage::url($request->file('archivo')->store('public/requisitos'));
                        //remplazamos en la base de datos
                        $requisito=File::where('id', $file->id)->update(['path' => $new_url ,'num_modifi'=>1]);
                         
                        return 'actualizado';
               
            }else{
                $url=Storage::url($request->file('archivo')->store('public/requisitos'));
                $requisito=File::create([
                    'path'=>$url,
                    'tramite_id'=>$request->tramite,
                    'persrol_id'=>$personarol,
                    'faserolreq_id'=>$request->idfaserequi,
                    'num_modifi'=>0,
                ]);

                return $requisito;
            }
      }else{
          return 'user no autorizado';
      }
     }






}
