<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\PersonaRole;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;

class AdminUserController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
    /*
         userdni:'',
          apePat:'',
          apeMat:'',
          nombresuser:'',
          genero:'',
          nacimiento:null,
          correo:'',
          celular:'',
          gradoestu:'',
          gradoabr:'',
          password:'',
          passwordconfirm:'',
          facultad:'',
          escuela:'',
          roles:[],
    */
    public function store(Request $request)
    {

        $this->validaruser($request);
        if((Persona::where('email',$request->correo)->count())>0){
            return '1';
        }else{
            $persona=Persona::create([
                'nom'=>$request->nombresuser,
                'apePat'=>$request->apePat,
                'apeMat'=>$request->apeMat,
                'gen'=>$request->genero,
                'dom'=>$request->direccion,
                'email'=>$request->correo,
                'tipDoc'=>1,
                'numDoc'=>$request->userdni,
                'fecNac'=>$request->nacimiento,
                'numcel'=>$request->celular,
                'grad_estud'=>$request->gradoestu,
                'abre_grad'=>$request->gradoabr,
                'espe'=>$request->escuela? $request->escuela['ID_ESC']:null,
            ]);
             
            $rolesuser=$this->agregarroles($persona->id,  $request->roles,  $request->facultad,  $request->escuela);    
            $user=$this->agregaruser($persona->id, $request->password,$request->password_confirmation,$request->nombresuser,$request->correo);    
            return response()->json([
                'persona'=>$persona,
                'roles'=>$rolesuser,
                'user'=>$user,
            ]);
        }

     
        
    }
    public function validaruser($request = null)
    {
        return $request->validate([
            'userdni' => 'required|max:12',
            'apeMat' => 'required',
            'nombresuser' => 'required',
            'genero' => 'required|max:1',
            'nacimiento' => 'required|date',
            'correo' => 'required|email',
            'celular' => 'required|max:9',
            'gradoestu' => 'required',
            'gradoabr' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation'=>'required',
            'roles' => 'required',
        ]);
    }

    public function agregarroles($idper,$roles,$facu,$escu){
        foreach ($roles as $rol ) {
            $roles=PersonaRole::create([              
                'estado'=>1,
                'persona_id'=>$idper,
                'facId'=>$facu ? $facu['FACULTAD_ID']:null,
                'escId'=> $escu ? $escu['ID_ESC']:null,
                'rol_id'=>$rol['id'],
            ]); 
        }
        return $roles;
    }
    public function agregaruser($idper,$pass,$passcon,$name,$email){
        $user=User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($pass),
            'persona_id'=>$idper,
        ]);
        return $user;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     /** */
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
        if($request->password=="" && $request->password_confirmation==""){
            $this->validarusersinpass($request);
            

        }else{
            $this->validaruser($request);
        }
   

    }
    public function validarusersinpass($request = null)
    {
        return $request->validate([
            'userdni' => 'required|max:12',
            'apeMat' => 'required',
            'nombresuser' => 'required',
            'genero' => 'required|max:1',
            'nacimiento' => 'required|date',
            'correo' => 'required|email',
            'celular' => 'required|max:9',
            'gradoestu' => 'required',
            'gradoabr' => 'required',
            'roles' => 'required',
        ]);
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
