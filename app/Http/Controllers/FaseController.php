<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fase;
use PhpParser\Node\Stmt\Break_;
use App\Models\FaseRolRequisito;

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
       // $numero=Fase::where('proceso_id',$request->procesoid)->count();
        //buscar numero en el registro
        //comprovar que ese numero de orden no exista en esta fase
        $num_exist=Fase::where('proceso_id',$request->procesoid)->where('numero',$request->numerofase)->count();    

        if($num_exist>0){
            return 'ya existe este numero de orden';
        }else{

            //comprovar si el numero es seguido
            $nums_fase=Fase::where('proceso_id',$request->procesoid)->count();

            if($request->numerofase==($nums_fase+1)){

                $fase = Fase::create([
                    'nombre' => $request->nombrefase,
                    'numero' => $request->numerofase,
                    'proceso_id' => $request->procesoid,
                    'fase_id' =>null,
                    'encargado_ejecutar'=>$request->rol_ejecutor['id'],
                    'encargado_revisar'=>$request->rol_revisar['id'],
                    ]);
                    return response()->json([
                        'fase'=>$fase,
                    ]);
            }else{
                return 'el numero de orden debe ser ascendente y ordenado';
            }



        }        

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
    public function destroy($fase)
    {
        $FaseDelete=FaseRolRequisito::where('fase_id',$fase)->delete();
        $fase = Fase::where('id',$fase)->delete();
        return response()->json([
            'mensaje'=>'Fase eliminada'
        ]);
    }
    public function validarfase($request=null){
        return $request->validate([
            'nombrefase' => 'required',
            'numerofase' => 'required|integer',
            'rol_ejecutor'=>'required',
            'rol_revisar'=>'required',
        ]);
    }
}
