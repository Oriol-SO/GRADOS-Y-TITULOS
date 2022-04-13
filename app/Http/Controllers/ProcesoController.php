<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso;
use App\Models\Grado;
use App\Models\Modalidade;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tramites['tramites'] = Proceso::all()->map(function ($t) {
            return [
                'id' => $t->id,
                'nombre' => $t->procNom,
                'grado_id' => $t->grado ? $t->grado_id : null,
                'grado' => $t->grado ? $t->grado->graNom : null,
                'modalidad_id' => $t->modalidade ? $t->moda_id : null,
                'modalidad' => $t->modalidade ? $t->modalidade->modNombre : null,
                'estado' =>$t->estado,
                'guardado' =>$t->guardado,
                'cantidad_fases' => $t->fase->count(),
                'cantidad_requisitos' => $t->fase->map(function ($f) {
                    return $f->faserolrequisito->count();
                })->sum(),
            ];
        });
        //$tramites['grados'] = Grado::all();
        //$tramites['modalidades'] = Modalidade::all();
        return response()->json($tramites, 200);
        //$procesos= Proceso::all();
        //return response()->json($procesos);
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
    public function store(Request $request){

            $this->validar($request);    
            $proceso = Proceso::create([
            'procNom' => $request->nombre,
            'grado_id' => $request->grado['id'],
            'moda_id' => $request->modalidad['id'],
            'tipo' => $request->tipo,
            'estado'=>0,
            'guardado'=>0,
        ]);
        return response()->json([
            'tramite'=>$proceso
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
        $proceso = Proceso::find($id);
         $response=[
             'nombre'=>$proceso->procNom,
             'guardado'=>$proceso->guardado,
             'estado'=>$proceso->estado,
         ];
        return response()->json($response, 200);
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

    public function validar($request = null)
    {
        return $request->validate([
            'nombre' => 'required',
            'grado' => 'required',
            'modalidad' => 'required'
        ]);
    }
    protected function cambiarEstado($id)
    {   
        
        $valor = Proceso::find($id);
        if($valor->guardado==1){
            $estado=$valor->estado;
            if($estado==1){
                $cambiado=0;
            }else{
                $cambiado=1;
            }
            $proceso=Proceso::where('id', $id)->update(['estado' => $cambiado]);
            return 'cambiado';
        }else{
            return 'el tramite no esta guardado';
        }
        
    }
    protected function cambiarGuardado($id)
    {   
        $valor = Proceso::find($id);
        if($valor->estado==0){
            $guardado=$valor->guardado;
            if($guardado==1){
                $guardado=0;
                $g=1;
            }else{
                $guardado=1;
                $g=0;
            }
            $proceso=Proceso::where('id', $id)->update(['guardado' => $guardado]);
            $valor = Proceso::find($id);
            return !($valor->guardado);
        }else{
            return 'el tramite esta activado';
        }
        
    }

  
}
