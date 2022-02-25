<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proceso;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $procesos= Proceso::all();
        return response()->json($procesos);
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

    public function validar($request = null)
    {
        return $request->validate([
            'nombre' => 'required',
            'grado' => 'required',
            'modalidad' => 'required'
        ]);
    }

  
}
