<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requisito;
use App\Models\FaseRolRequisito;
class RequisitoController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitos= Requisito::all('nombre','id');

        return response()->json($requisitos);
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
        $this->validarrequisitoNuevo($request);
        $requisito=Requisito::create([
            'nombre' => $request->nombre,
            'tipo_documento' => $request->extension,
            'tipoarchi_id' =>$request->tipodocumento['id'],
            'html_formato'=>null,
            ]);
        
        $faserol=$this->insertarfaserequisito($requisito->id,$request->fase_id,$request->rol['id']); 
         return response()->json([
           'faserolreq'=>$faserol,
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
    public function validarrequisitoNuevo($request=null){
        return $request->validate([
            'nombre'=>'required',
            'rol'=>'required',
            'tipodocumento'=>'required',
            'extension'=>'required',
        ]);
    }
    public function insertarfaserequisito($id,$faseid,$rolid){  
        $faserequisito = FaseRolRequisito::create([
            'rol_id' => $rolid,
            'requisito_id' => $id,
            'fase_id' =>$faseid,
            ]);
            return response()->json([
                'faserequisito'=>$faserequisito,
            ]); 
    }
}
