<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;

use App\Models\Fase;
use App\Models\Modalidade;
use App\Models\Tramite;
use Illuminate\Http\Request;
use App\models\Persona;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Carbon\Carbon;

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
            'fec-inicio'=> Carbon::now(),
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
