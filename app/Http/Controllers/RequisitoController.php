<?php

namespace App\Http\Controllers;

use App\Models\Fase;
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
        $categoria=$request->categoria['id'];
        if($categoria==0){
            $requisito=Requisito::create([
                'nombre' => $request->nombre,
                'tipo_documento' => $request->extension,
                'tipoarchi_id' =>$request->tipodocumento['id'],
                'html_formato'=>null,
                'tipo_requisito'=>0,
                ]);
                $this->insertarfaserequisito($requisito->id,$request->fase_id); 
         
        }else if($categoria==1 || $categoria==2){
            //buscamos en toda la lista de requisitos que no exista un requisito con este tipo de nombre
            $c=Requisito::where('tipo_requisito',$request->categoria)->count();

            if($c>0){
                return 'EXIST_DOC';
            }else{
                $requisito=Requisito::create([
                    'nombre' => $request->nombre,
                    'tipo_documento' => $request->extension,
                    'tipoarchi_id' =>$request->tipodocumento['id'],
                    'html_formato'=>null,
                    'tipo_requisito'=>$request->categoria,
                    ]);
                    $this->insertarfaserequisito($requisito->id,$request->fase_id); 
                      
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
    public function destroy(Requisito $requisito)
    {
        $requisito->delete();
        return response()->json([
            'mensaje'=>'Requisito eliminado'
        ]);
    }
    public function validarrequisitoNuevo($request=null){
        return $request->validate([
            'nombre'=>'required',
            //'rol'=>'required',
            'tipodocumento'=>'required',
            'extension'=>'required',
            'categoria'=>'required',
        ]);
    }
    public function insertarfaserequisito($id,$faseid){  

        //obtener rol ejecutor
        $rol_ejecutor=(Fase::where('id',$faseid)->first())->encargado_ejecutar;
        //insertar
        $faserequisito = FaseRolRequisito::create([
            'rol_id' => $rol_ejecutor,
            'requisito_id' => $id,
            'fase_id' =>$faseid,
            ]);
            return response()->json([
                'faserequisito'=>$faserequisito,
            ]); 
    }
}
