<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;

class FaseController extends Controller
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
        $this->validarfase($request);
        $numero=Fase::where('proceso_id',$request->procesoid)->count();
        //buscar numero en el registro
            $fase = Fase::create([
                'nombre' => $request->nombrefase,
                'numero' => $numero+1,
                'proceso_id' => $request->procesoid,
                'fase_id' =>null,
                ]);
                return response()->json([
                    'fase'=>$fase,
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
        $fase=Fase::where('proceso_id', $id)->orderBy('numero', 'asc')->oldest()->get();
       // $primerid=Fase::where('proceso_id', $id)->get();
        return response()->json($fase, 200);
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
    public function validarfase($request=null){
        return $request->validate([
            'nombrefase' => 'required',
           // 'numerofase' => 'required|integer'
        ]);
    }
}
