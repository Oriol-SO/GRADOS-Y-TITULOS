<?php

namespace App\Http\Controllers;

use App\Models\Tramite;
use App\Models\Persona;
use App\Models\FaseRolRequisito;
use App\Models\Fase;
use App\Models\File;
use Illuminate\Http\Request;

class SecretariaController extends Controller
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

    //secretaria general tramites 
    public function sf_expedientes(){
        $expedientes=Tramite::all()->map(function($e){
            return[
                'per_nom'=>$e->persona->nom.' '.$e->persona->apePat.' '.$e->persona->apeMat,
               // 'per_apepat'=>$e->persona->apePat,
                //'per_apemat'=>$e->persona->apeMat,
                'id'=> $e->id,
                'fec_inicio'=>$e-> fec_inicio,
                'estado'=>$e->estado,
                'tramite'=>$e->tipo_tramite,
            ];
        });
        return response()->json($expedientes);
    }
    public function sf_obtenertramite($id){
        $tramites = tramite::find($id);
        return response()->json($tramites);
    }
    public function sf_obtenerfasestramite($id){
        $fase['fases']=Fase::where('proceso_id', $id)->get();
        $fase['cantidad']=Fase::where('proceso_id', $id)->get()->count();
        //$fase=Fase::all();
        return response()->json($fase);
    }
    public $tram=null;
    public function sf_requisitosfase($id, $tramite ){    
        $this->tram=$tramite;    
        $rol_sf=5;
        if($rol_sf===5){
            $requisitos['alumno'] = FaseRolRequisito::where('fase_id',$id)->where('rol_id',10)->get()->map(function ($r) {
                return [
                    'id' => $r->id,       
                    'requisito_id' => $r->requisito_id ,
                    'nombre' => $r->requisito ->nombre ,
                    'rol'=> $r->rol->id,
                    'documento'=>$r->requisito->TipoArchivo->tipoNombre,
                    'extension'=>$r->requisito ->tipo_documento,
                    'archivo'=>File::where('tramite_id',$this->tram)->where('faserolreq_id',$r->id)->get(),
                ];
            });

            

            $requisitos['propios']=FaseRolRequisito::where('fase_id',$id)->where('rol_id',$rol_sf)->get()->map(function ($r) {
                return [
                    'id' => $r->id,       
                    'requisito_id' => $r->requisito_id ,
                    'nombre' => $r->requisito ->nombre ,
                    'rol'=> $r->rol->rolNombre,
                    'documento'=>$r->requisito->TipoArchivo->tipoNombre,
                    'extension'=>   $r->requisito ->tipo_documento,               
                ];
            });
            return response()->json($requisitos);
        }else{
            return 'usuario no autorizado';
        }

    }

    protected function sf_archivorequisito($tramite , $fasereq){
        $rol=5;
        if($rol===5){
            $archivo=File::where('tramite_id',$tramite)->where('faserolreq_id',$fasereq)->get();
            return response()->json($archivo);
        }else{
            return 'user no autorizado';
        }
        
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
