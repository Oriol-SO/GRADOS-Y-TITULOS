<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use App\Models\Persona;
use App\Models\Estado;
use App\Models\FaseRolRequisito;
use App\Models\Fase;
use App\Models\File;
use App\Models\Observacione;
use App\Models\Revisione;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SecretariaVicerrectoradoController extends Controller
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function sv_expedientes(){
        $rol=5;
        if($rol==5){
            $expedientes=Tramite::all()->map(function($e){
                return[
                    'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
                   // 'per_apepat'=>$e->persona->apePat,
                    //'per_apemat'=>$e->persona->apeMat,
                    'id'=> $e->id,
                    'tramite'=>$e->tipo_tramite,
                    //'facultad'=>$e->
                    'fec_inicio'=>$e-> fec_inicio,
                    'estado'=>$e->estado,
                    'tramite'=>$e->tipo_tramite,
                    'total_requisitos'=>FaseRolRequisito::whereIn('fase_id',(Fase::where('proceso_id',$e->proceso_id)->get('id')))->count(), 
                    'requisitos_aprovados'=>$e->file->map(function($f){
                        return $f->Revisione->count();
                    })->sum(),

                    'notificacion'=>$e->receptor_rol_notify==11? true:false,
                ];
            });

           
            return response()->json($expedientes);
        }else{
            return 'user no autorizado';
        }
    }
    protected function sv_obtenerfasestramite($id){
        $fase['fases']=Fase::where('proceso_id', $id)->where(function($query) {
            $query->where('encargado_ejecutar', 11)
                  ->orWhere('encargado_revisar', 11);
        })->orderBy('numero', 'asc')->get();
      //  $fase['fases_ejecutar']=Fase::where('proceso_id', $id)->where('encargado_ejecutar',5)->orderBy('numero', 'asc')->oldest()->get();
        $fase['cantidad']=Fase::where('proceso_id', $id)->where(function($query) {
            $query->where('encargado_ejecutar', 11)
                  ->orWhere('encargado_revisar', 11);
        })->get()->count();
        //$fase['cantidadCorrespondiente']=Fase::where('proceso_id', $id)->where('encargado_ejecutar',5)->get()->count();
        $fase['fases_tramite']=Fase::where('proceso_id',$id)->orderBy('numero', 'asc')->get();
        //$fase=Fase::all();
        return response()->json($fase);
    }

    public $tram=null;
    public function sv_requisitosfase($id, $tramite ){    
        $this->tram=$tramite;    

        $rol_sf=11;
        if($rol_sf===11){
                //desabilitar notificacion 
                 //obtener rol revisador 
                 //$fase_revision=Fase::where('id',$id)->first();
                // $revisador=$fase_revision->encargado_revisar;
                 $tramite_revision=Tramite::where('id',$this->tram)->first();

                 if($tramite_revision->fase_actual!=null){
                        if(11==$tramite_revision->receptor_rol_notify){
                            //eliminar notificacion
                            Tramite::where('id',$this->tram)->update(['receptor_rol_notify'=>null]);
                        }
                    }


            $requisitos['revisar'] = FaseRolRequisito::where('fase_id',$id)->where('rol_id',5)->get()->map(function ($r) {
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

    protected function sv_revisarrequisito(Request $request){
        // return $request;
         $rol=11;
         if($rol===11){
             //nuscar registros de revision anteriores
             $revisados=Revisione::where('file_id',$request->file['id'])->count();
             if($revisados>0){
                 return 'ya aprobaste este requisito';
             }else{               
                 if($request->observado==false && $request->aprovado==false){
                     return '1'; //seleccione una opcion
                 }else{
                     if($request->observado==false && $request->aprovado==true){
                         //aprovado
                         $revision=Revisione::where('file_id',$request->file['id'])->count();
                         if($revision>0){
                             return '2';
                         }else{
                             //eliminar observaciones para aprobar
                             Observacione::where('file_id', $request->file['id'])->delete();       
 
                             $revision=Revisione::create([
                                 'file_id'=>$request->file['id'],
                                 'persrol_id'=>$request->file['persrol_id'],
                                 'estado_id'=>3,
                                 'estado' =>true,
                                 
                             ]);
                             //cambiar estado de modificacion del archivo 
                             File::where('id',$request->file['id'])->update(['num_modifi'=>0]);
                             return $revision;
                         }
                     
                     }else if($request->observado==true && $request->aprovado==false){
                         //observacion
                         $request->validate([
                             'observacion'=>'required',
                         ]);
                         //eliminar observaciones anteriores
                         Observacione::where('file_id', $request->file['id'])->delete();  
                         //reescribir observacion
                         $observacion=Observacione::create([
                             'file_id'=>$request->file['id'],
                             'persrol_id'=>$request->file['persrol_id'],
                             'texto'=>$request->observacion,
                 
                         ]);
                             //cambiar estado de modificacion del archivo 
                             File::where('id',$request->file['id'])->update(['num_modifi'=>0]);
                         return $observacion;
                     }
                 }
             }
         }else{
             return 'user no autorizado';
         }
     }


     protected function sv_subirrequisito(Request $request){
        $rol=11;
        if($rol===11){
                       
            $user=$request->user();
            // $persona=$user->persona_id;
            $personarol=$user->persona->personarole[0]->id;
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

    public function sv_fasecheck($id_tram,$id_fase){
        try{ 
            //comprovar si esta fase esta aprovada
            $fase_tramite=(Tramite::where('id',$id_tram)->first())->fase_actual;

            $fase=Fase::where('id',$id_fase)->first();
            //obtener rol del revisador
            if($fase->encargado_revisar==11 ||$fase->encargado_ejecutar==11 ){
                $fase_actual=$fase->numero;
                if($fase_actual==$fase_tramite){
                    $tramite_fase=Tramite::where('id',$id_tram)->update(['fase_actual'=>($fase_actual+1)]);
                    return '1';
                }else{
                    if($fase_actual<$fase_tramite){
                        return '2';
                    }else if($fase_actual>$fase_tramite){
                        return '3';
                    }
                    //return 'no se puede aprovar esta fase';
                }

            }else{
                return 'no estas autorizado para esta accion';
            }
        }catch(Exception $e){
            return $e;
        } 
    }


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
