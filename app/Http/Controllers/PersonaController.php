<?php

namespace App\Http\Controllers;
use App\Models\Persona;
use App\Models\PersonaRole;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Http;
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
                'nom'=>$p->nom,
                'apePat'=>$p->apePat,
                'apeMat'=>$p->apeMat,
                'gen'=>$p->gen,
                'dom'=>$p->dom,
                'email'=>$p->email,
                'tipDoc'=>$p->tipDoc,
                'numDoc'=>$p->numDoc,
                'fecNac'=>$p->fecNac,
                'numcel'=>$p->numcel,
                'grad_estud'=>$p->grad_estud,
                'abre_grad'=>$p->abre_grad,
                'espe'=>$p->espe,
                'cod_alum'=>$p->cod_alum,
                'facu'=>$p->PersonaRole->map(function($r){
                    return[
                        'facId'=>$r->facId,
                    ];
                }),
                'roles'=>$p->PersonaRole->map(function($r){
                    return[
                        'rolNombre'=>"",
                        'id'=>$r->rol_id,                        
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

    public function buscarusercodigo($codigo)
    {   

            $response = Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/'.$codigo);
            return $response;
    }

    public function buscardniuser($codigo){
        $response=Http::get('https://dniruc.apisperu.com/api/v1/dni/'.$codigo.'?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImpjbGF1cmVhbm96QGdtYWlsLmNvbSJ9.xfmGDbSyPq016GIiuDHiyevun8bb2Avl2EBjYqXAQZA');
        return $response;
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
    

