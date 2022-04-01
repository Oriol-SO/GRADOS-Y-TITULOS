<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;

use App\Models\Fase;
use App\Models\Modalidade;
use App\Models\Tramite;
use Illuminate\Http\Request;
use App\models\Persona;
use App\models\PersonaRole;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Carbon\Carbon;
use App\Models\FaseRolRequisito;
use App\Models\File;
use App\Models\Observacione;
use App\Models\Revisione;
use Illuminate\Support\Facades\Storage;

class tramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request)
    {
        //traemos los tramites del alumno
        $user=$request->user();
        $tramites = tramite::where('persona_id',$user->persona_id)->get();
        return response()->json($tramites);
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
        $this->validar($request);
        $user=$request->user();
        $persona=$user->persona;
        //$modalidad=Modalidade::find($request->tipotramite['modalidad_id']);
        //$fase=Fase::where('proceso_id','')->limit(1)->get();
        $tramite=Tramite::create([
            'fec_inicio'=> Carbon::now(),
            'fecha_vencimiento'=>null,
            'modo_obtencion'=> $request->tipotramite['modalidad'],
            'tipo_tramite'=>$request->tipotramite['nombre'],
            'fase_actual'=>'1',
            'estado'=>0,
            'trabajo_id'=>null,
            'persona_id'=>$persona->id,
            'proceso_id'=>$request->tipotramite['id'],
            'consejo_id'=>null,
            'resolucion_id'=>null,         
        ]);

        return response()->json($tramite);

    }
    public function validar($request=null){
       return  $request->validate([
            'tipotramite' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        $tramites = tramite::find($id);
        return response()->json($tramites);
    }

    public function obtenerfases($codigo){
        $fase['fases']=Fase::where('proceso_id', $codigo)->get();
        $fase['cantidad']=Fase::where('proceso_id', $codigo)->get()->count();
        //$fase=Fase::all();
        return response()->json($fase);
    }
    public $tram=null;
    protected function obtenerfaserequisito($id,$tramite){
        $this->tram=$tramite;
        $rol=10;
        if($rol===10){
            $requisitos['alumno'] = FaseRolRequisito::where('fase_id',$id)->where('rol_id',10)->get()->map(function ($r) {
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
            $requisitos['subidos']=0;
            $requisitos['aprovados']=0;
            $requisitos['observados']=0;            
           foreach ($requisitos['alumno'] as $req) {
               if(count($req['revisado_aprovado'])>0){
                $requisitos['aprovados']++;
               }elseif(count($req['revisado_observado'])>0){
                $requisitos['observados']++;
               }
               if(count($req['archivo_subido'])>0){
                $requisitos['subidos']++;
               }
           } 
           

            return response()->json($requisitos);
        }else{
            return 'user no autorizado';
        }
 
    }

    protected function subirarchivorequisito(Request $request){
        $rol=10;
        if( $rol===10){
                       
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
                //buscar observaciones
                $obser=Observacione::where('file_id',$file->id)->count();
                if($obser>0 && $file->num_modifi==0){
                    //borramos el archivo de la carpeta
                    $url_borrar=str_replace('storage','public',$file->path);
                       Storage::delete($url_borrar);
                    //subimos la nueva ruta 
                   
                        $new_url=Storage::url($request->file('archivo')->store('public/requisitos'));

                        //remplazamos en la base de datos
                        $requisito=File::where('id', $file->id)->update(['path' => $new_url ,'num_modifi'=>1]);
                         
                        return 'actualizado';
                   
                }else{
                    return 1;
                }
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
