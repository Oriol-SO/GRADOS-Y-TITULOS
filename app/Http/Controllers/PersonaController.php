<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\PersonaRole;
use GuzzleHttp\Client;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Stmt\Catch_;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $personas=Persona::all()->map(function($p){
            return [
                'id'=>$p->id,
                'nombre_user'=>$p->nom.' '.$p->apePat.' '.$p->apeMat,
                'nom'=>$p->nom,
                'apePat'=>$p->apePat,
                'apeMat'=>$p->apeMat,
                'gen'=>$p->gen,
                //'dom'=>$p->dom,
                'email'=>$p->email,
                'tipDoc'=>$p->tipDoc,
                'numDoc'=>$p->numDoc,
                //'fecNac'=>$p->fecNac,
                //'numcel'=>$p->numcel,
                //'grad_estud'=>$p->grad_estud,
                //'abre_grad'=>$p->abre_grad,
                'curri'=>$p->curri,
                'fec_matri'=>$p->fec_matri,
                'espe'=>$p->espe,
                'cod_alum'=>$p->cod_alum,
                'facu'=>$p->PersonaRole->map(function($r){
                    return[
                        'facId'=>$r->facId,
                    ];
                }),
                'roles'=>$p->PersonaRole->map(function($r){
                    return[
                        'estado'=>$r->estado,
                        'id'=>$r->id,
                        'escuela'=>$r->escId,
                        'facultad'=>$r->facId,
                        'roles'=>$r->rol->rolNombre,
                        'rol_id'=>$r->rol_id,                   
                    ];
                }),
               // 'user'=>$p->user,
            ];
        });
        
        return response()->json($personas);
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($codigo)
    {
       
    }



    public function buscardniuser($codigo){
        try{
        $response=Http::get('https://dniruc.apisperu.com/api/v1/dni/'.$codigo.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpjbGF1cmVhbm96QGdtYWlsLmNvbSJ9.xfmGDbSyPq016GIiuDHiyevun8bb2Avl2EBjYqXAQZA');
        return $response;
        }catch(Exception){
            return 'ERROR';
        }
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
    

