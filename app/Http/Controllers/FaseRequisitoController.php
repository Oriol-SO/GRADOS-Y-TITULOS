<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaseRolRequisito;
use App\Models\Requisito;

class FaseRequisitoController extends Controller
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
        /*$requisitos=FaseRolRequisito::where('fase_id',$id)->get();
                return [
                    'faserequisito' => $requisitos->id,
                    'requisito_id' => $requisitos->requisito_id,
                    'nombre' => $requisitos->requisito->nombre,                   
                    
                ];*/
                $requisitos['requisitos'] = FaseRolRequisito::where('fase_id',$id)->get(function ($r) {
                    return [
                        'id' => $r->id,       
                        'requisito_id' => $r->requisito ? $r->requisito_id : null,
                        'requiNom' => $r->requisito ? $r->requisito->nombre : null,                        
                    ];
                });
        return response()->json($requisitos,200);
                        
}

    /**
     * Show the form for editing the specified resource.
     *select from users
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
