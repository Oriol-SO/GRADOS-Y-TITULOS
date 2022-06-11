<?php

namespace App\Http\Controllers;

use App\Models\Involucrado;
use App\Models\Persona;
use App\Models\PersonaRole;
use App\Models\Tramite;
use Illuminate\Http\Request;

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
