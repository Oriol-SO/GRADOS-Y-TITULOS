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
use App\Models\Proceso;
use App\Models\Revisione;
use App\Models\Consejo;
use App\Models\Grado;
use App\Models\Involucrado;
use App\Models\LineaDeInvestigacione;
use App\Models\LineaInvestigacione;
use App\Models\LineaInvestigacionEscuela;
use App\Models\Trabajo;
use Illuminate\Support\Facades\Storage;
use Symfony\Contracts\Service\Attribute\Required;

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
        $tramites = tramite::where('persona_id',$user->persona_id)->get()->map(function($e){
            return[
                //'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
                // 'per_apepat'=>$e->persona->apePat,
                 //'per_apemat'=>$e->persona->apeMat,
                 'id'=> $e->id,
                 'tipo_tramite'=>$e->tipo_tramite,
                 'modo_obtencion'=>$e->modo_obtencion,
                 'fec_inicio'=>$e-> fec_inicio,
                 'estado'=>$e->estado,
                 'numero_fase'=>$e->numero,
                 'tramite'=>$e->tipo_tramite,
                 'total_fases'=>Fase::where('proceso_id',$e->proceso_id)->count(), 
                 'fase_actual'=>$e->fase_actual,
            ];
        });
        return response()->json($tramites);
    }

    protected function alu_grados(){
        $grados=Grado::all()->map(function($g){
            return[
                'id'=>$g->id,
                'graNom'=>$g->graNom
             ];
        });
        return $grados;
    }

    protected function lineas_inv(){
            return response()->json(LineaDeInvestigacione::all(),200);
    }

   protected function alu_procesos($grado){

    $tramites['tramites'] = Proceso::where('grado_id',$grado)->where('estado',1)->get()->map(function($t){
        return [
            'id' => $t->id,
            'nombre' => $t->procNom,
            'grado_id' => $t->grado ? $t->grado_id : null,
            'grado' => $t->grado ? $t->grado->graNom : null,
            'modalidad_id' => $t->modalidade ? $t->moda_id : null,
            'modalidad' => $t->modalidade ? $t->modalidade->modNombre : null,
        ];
    });
    return $tramites ;
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
       
        //$this->validar($request);
        

        $request->validate([
            'grado'=>'required',
            'tipotramite'=>'required'
        ]);


        if ($request->grado['id']==2){
            $request->validate([
                'grado'=>'required',
                'tipotramite'=>'required',
                'titulo'=>'required',
                'integrantes'=>'required',
                'linea_inv'=>'required',
                'url'=>'required',
            ]);

             
            //guardar el plan

            $url_plan_tesis=Storage::url($request->file('url')->store('public/planTesis'));           
            //crear el trabajo
            
           $trabajo= Trabajo::create([
                'modo_sustentacion'=>'PRESENCIAL',
                'url_repositorio'=>$url_plan_tesis,
                'nombre'=>$request->titulo,
                'lineainv_id'=>$request->linea_inv['id'],
            ]);
            $user=$request->user();
            $persona=$user->persona;
            Involucrado::create([
                'trabajo_id'=>$trabajo->id,
                'persrol_id'=>(PersonaRole::where('persona_id',$persona->id)->first())->id,
                'rol_id'=>(PersonaRole::where('persona_id',$persona->id)->first())->rol_id,
                'estado'=>1,
            ]);
            //creamos el tramite
            $this->add_tramite($request,$trabajo->id);

        }else if($request->grado['id']==1){                      
            $this->add_tramite($request,null);
        }else{
            return 'no esta disponible';
        }
     
    }
    public function add_tramite($request,$trabajo){
        $user=$request->user();
        $persona=$user->persona;
        $tramite=Tramite::create([
            'fec_inicio'=> Carbon::now(),
            'fecha_vencimiento'=>null,
            'modo_obtencion'=> $request->tipotramite['modalidad'],
            'tipo_tramite'=>$request->tipotramite['nombre'],
            'fase_actual'=>'1',
            'estado'=>0,
            'trabajo_id'=>$trabajo,
            'persona_id'=>$persona->id,
            'proceso_id'=>$request->tipotramite['id'],
            'consejo_id'=>null,
            'resolucion_id'=>null,         
        ]);

        return 'agregado';        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {  
        
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
            ];
        });
        return response()->json($tramites[0],200);
    }

    public function obtenerfases($codigo){
        $fase['fases']=Fase::where('proceso_id', $codigo)->orderBy('numero', 'asc')->oldest()->get();
        $fase['cantidad']=Fase::where('proceso_id', $codigo)->get()->count();
        //$fase=Fase::all();
        return response()->json($fase);
    }
    public $tram=null;
    protected function obtenerfaserequisito($id,$tramite){
        $this->tram=$tramite;
        $rol=10;
        if($rol===10){
                //obtener id fase anterior 

              /*  $numero_actual=(Fase::where('id',$id)->first())->numero;
                if($numero_actual>1){
                    $num_anterior=$numero_actual-1;
                    //obtener el proceso id
                    $proc_id=(Tramite::where('id',$tramite)->first())->proceso_id;
                    //obtener fase anterior
                    $fase=(Fase::where('proceso_id',$proc_id)->where('numero',$num_anterior)->first())->id;

                    $autorized=$this->alu_autorized($fase,$tramite);
                    $requisitos['autorized']=$autorized;
                }*/
               

       
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
           
            //$requisitos['num_fase_ant']=$num_req;  
            //$requisitos['total_req']=FaseRolRequisito::where('fase_id',$id)->count();       
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
            
           //otros requisitos 
           $requisitos['otros']=FaseRolRequisito::where('fase_id',$id)->where('rol_id','<>',10)->get()->map(function($o){
               return[
                'nombre' => $o->requisito ->nombre ,
                'rol' =>$o->rol->rolNombre,
               ];
           });

            $requisitos['otros_detalles']=$this->otros_detalles_de_fase($id,$tramite);     

            return response()->json($requisitos);
        }else{
            return 'user no autorizado';
        }
 
    }

    protected function otros_detalles_de_fase($id,$tramite){
           $numeroFase=(Fase::where('id',$id)->first())->numero;
           $fase_actual=(Tramite::where('id',$tramite)->first())->fase_actual;

           if($numeroFase==4){
               if($numeroFase<$fase_actual){
                  //consejo
                  return [['NOMBRE'=>'','VALOR'=> 'tu tramite ya esta agendado'],['NOMBRE'=>'CONSEJO','VALOR'=>'1']];
                }else{
                  return 'tu tramite esta en espera de ser agendado';                
                }
                   
            }else if($numeroFase==5){
                
                if($numeroFase<$fase_actual){
                    //resolucion
                    return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                        return[
                            ['NOMBRE'=>'Consejo','VALOR'=>$t->consejo->numero],
                            ['NOMBRE'=>'Fecha de consejo','VALOR'=>$t->consejo->fecha],
                        ];
                    });
                }else{
                    return 'tu tramite esta en espera de pasos anteriores';                
                }
                
            }
           else if($numeroFase==6){
                if($numeroFase<$fase_actual){
                    return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                        return[
                            ['NOMBRE'=>'Consejo','VALOR'=>$t->consejo->numero],
                            ['NOMBRE'=>'Fecha de consejo','VALOR'=>$t->consejo->fecha],
                            ['NOMBRE'=>'Número de oficio','VALOR'=>$t->consejo->num_oficio],
                        ];
                    });
                }else{
                    return 'tu tramite esta en espera de pasos anteriores';                
                }
           }else if($numeroFase==7){ 
                if($numeroFase<$fase_actual){
                    return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                        return[
                            ['NOMBRE'=>'Resolucion','VALOR'=>$t->resolucione->numero],
                            ['NOMBRE'=>'Fecha de resolucion','VALOR'=>$t->resolucione->fecha],
                        ];
                    });
                }else{ 
                    return 'tu tramite esta en espera de pasos anteriores';                
                }
           }
           else if($numeroFase==8){ 
                if($numeroFase<$fase_actual){
                    return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                        return[
                            ['NOMBRE'=>'Libro','VALOR'=>$t->diploma->num_lib],
                            ['NOMBRE'=>'Folio','VALOR'=>$t->diploma->lib_foli],
                            ['NOMBRE'=>'Registro','VALOR'=>$t->diploma->num_lib_regis],
                        ];
                    });
                }else{
                    return 'tu tramite esta en espera de pasos anteriores';                
                }
           }
           else if($numeroFase==9){ 
                if($numeroFase<$fase_actual){
                //consejo
                    return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                        return[
                            ['NOMBRE'=>'Estado','VALOR'=>'ya esta impreso'],
                            ['NOMBRE'=>'Libro','VALOR'=>$t->diploma->num_lib],
                            ['NOMBRE'=>'Folio','VALOR'=>$t->diploma->lib_foli],
                            ['NOMBRE'=>'Registro','VALOR'=>$t->diploma->num_lib_regis],
                            ['NOMBRE'=>'Sticker','VALOR'=>$t->diploma->num_sticker],
                        ];
                    });
                }else{
                    return 'tu tramite esta en espera de obtener un numero de sticker';                
                }
           }else if($numeroFase==10){
            if($numeroFase<$fase_actual){
                //consejo
                //fecha de entrega para el dia tal
                return 'tu tramite ya tiene una fecha para ser entregado';
                
                /*
                return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                    return[
                        'estado'=>'programado',
                        'libro'=>$t->diploma->num_lib,
                        'Folio'=>$t->diploma->lib_foli,
                        'registro'=>$t->diploma->num_lib_regis,
                        'sticker'=>$t->diploma->num_sticker,
                        
                    ];
                });*/
              }else{
                return 'tu tramite esta en espera de ser programado para entrega';                
              }
           }else if($numeroFase==11){          
                //consejo
                if($numeroFase<$fase_actual){
                    //consejo
                    return $consejo=Tramite::where('id',$tramite)->get()->map(function($t){
                        return[
                            ['NOMBRE'=>'Estado','VALOR'=>'programado'],
                            ['NOMBRE'=>'Libro','VALOR'=>$t->diploma->num_lib],
                            ['NOMBRE'=>'Folio','VALOR'=>$t->diploma->lib_foli],
                            ['NOMBRE'=>'Registro','VALOR'=>$t->diploma->num_lib_regis],
                            ['NOMBRE'=>'Sticker','VALOR'=>$t->diploma->num_sticker],
                            ['NOMBRE'=>'Fecha de entrega','VALOR'=>$t->diploma->fec_hor_entre],
                        ];
                    });
                }else{
                    return 'tu tramite esta en espera de ser programado';                
                }           
           }
           if($numeroFase==12){
            if($numeroFase<$fase_actual){
               //consejo
               return 'felicidades ya tienes tu bachiller';
             }else{
               return 'tu tramite aun no se ha finalizado ';                
             }
                
         }
           else{
               return null;
           }
           /*$otros_detalles=Tramite::where('fase_actual','>',)->where('id',$this->tram)->get()->map(function($e){
               return[
                'tipo_tramite'=>$e->tipo_tramite,
                'modo_obtencion'=>$e->modo_obtencion,
                'fec_inicio'=>$e-> fec_inicio,
                'estado'=>$e->estado,
                'numero_fase'=>$e->numero,
                'tramite'=>$e->tipo_tramite,
                'c'=>$e->consejo->numero,
                'consejo'=>$e->consejo->map(function($c){
                    return[
                        'numero de consejo'=>$c->numero,
                        'numero de oficio'=>$c->num_oficio,
                        'fecha de consejo'=>$c->fecha,
                    ];
                }),
                'resolucion'=>$e->resolucione->map(function($r){
                    return[
                        'numero de resolucion'=>$r->numero, 
                        'fecha de resolucion'=>$r->fecha,                       
                    ];
                }),
                'diploma'=>$e->diploma->map(function($d){
                    return[
                        'Libro'=>$d->num_lib,
                        'Registro'=>$d->num_lib_regis,
                        'Folio'=>$d->lib_foli,
                        'sticker'=>$d->num_sticker,
                        'fecha y hora de entrega'=>$d->fec_hor_entre,
                     ];
                }),
            ];
           });  */
    }



    public $tramfase;
    protected function alu_autorized($fase,$tramite){
         $this->tramfase=$tramite;          
        $aprovados= FaseRolRequisito::where('fase_id',$fase)->where('rol_id',10)->get()->map(function ($r) {
            return [
                'revisado_aprovado'=>Revisione::whereIn('file_id',(File::where('tramite_id',$this->tramfase)->where('faserolreq_id',$r->id)->get('id')))->get(),
         
            ];
        });
        $requisitos['aprovados']=0;
        $requisitos['total']=FaseRolRequisito::where('fase_id',$fase)->count();
        foreach ($aprovados as $req) {
            if(count($req['revisado_aprovado'])>0){
             $requisitos['aprovados']++;
            }
        }
        
        if( $requisitos['aprovados']=== $requisitos['total']){
            return true;
        }else{
            return 'no tienes permiso todavia o existe una alteracion en la base de datos';
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


    protected function notificarCambio($fase_id,$tramite){
        $numero_fase_actual=(Tramite::where('id',$tramite)->first())->fase_actual;
        $fase=(Fase::where('id',$fase_id)->first());
        $fase_num_a_notificar=$fase->numero;
        
        if($fase_num_a_notificar<$numero_fase_actual){
            return '0';
        }else{
            $receptor_notify=$fase->encargado_revisar;
            Tramite::where('id',$tramite)->update(['receptor_rol_notify'=>$receptor_notify]);
            return '1';
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
    public function destroy($id){
    }
}
