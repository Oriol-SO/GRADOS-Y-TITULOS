<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\PersonaRole;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use phpDocumentor\Reflection\Types\Null_;

class AdminUserController extends Controller
{
   // use RegistersUsers;
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
            try{
                $persona=Persona::create([
                    'nom'=>$request->nombresuser,
                    'apePat'=>$request->apePat,
                    'apeMat'=>$request->apeMat,
                    'gen'=>$request->genero,
                    //'dom'=>$request->direccion,
                    'email'=>$request->correo,
                    'tipDoc'=>$request->tipodoc['num'],
                    'numDoc'=>$request->userdoc,
                    //'fecNac'=>$request->nacimiento,
                    //'numcel'=>$request->celular,
                    'grad_estud'=>$request->gradoestu,
                    'abre_grad'=>$request->gradoabr,
                    'espe'=>$request->escuela? $request->escuela['ID_ESC']:null,
                    'cod_alum'=>$request->codalum? $request->codalum:null,
                ]);
                
                $rolesuser=$this->agregarroles($persona->id,  $request->roles);    
                $user=$this->agregaruser($persona->id, $request->userdoc,$request->nombresuser,$request->correo);    
                return response()->json([
                    'persona'=>$persona,
                    'roles'=>$rolesuser,
                    'user'=>$user,
                ]);
            }catch(Exception){
               
                try{ Persona::where('id',$persona->id)->delete();}catch(Exception){
                    return '2';

                }
                return '2';
            }
        }
   
     
        
    }
    public function validaruser($request = null)
    {
        return $request->validate([
            'userdoc' => 'required|max:12',
            'apeMat' => 'required',
            'nombresuser' => 'required',
            'genero' => 'required|max:1',
            //'nacimiento' => 'required|date',
            'correo' => 'required|email',
            //'celular' => 'required|max:9',
            'gradoestu' => 'required',
            'gradoabr' => 'required',
            //'password' => 'required|confirmed',
            //'password_confirmation'=>'required',
            'roles' => 'required',
        ]);
    }

    public function agregarroles($idper,$roles){
        foreach ($roles as $rol ) {
            $roles=PersonaRole::create([              
                'estado'=>1,
                'persona_id'=>$idper,
                'facId'=>$rol['facultad']? $rol['facultad']['FACULTAD_ID']:null,
                'escId'=> $rol['escuela'] ?$rol['escuela']['ID_ESC'] :null,
                'rol_id'=>$rol['roles']['id'],
            ]); 
        }
        return $roles;
    }
    public function agregaruser($idper,$pass,$name,$email){

        $fecha=now();
        $user=User::create([
            'name'=>$name,
            'email'=>$email,
            'email_verified_at'=>$fecha,
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

     /* 
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
     */
    public function validaruserUpdate($request = null)
    {
        return $request->validate([
            'userdoc' => 'required|max:12',
            'apeMat' => 'required',
            'nombresuser' => 'required',
            'genero' => 'required|max:1',
            //'nacimiento' => 'required|date',
            'correo' => 'required|email',
            //'celular' => 'required|max:9',
            'gradoestu' => 'required',
            'gradoabr' => 'required',
            //'password' => 'required|confirmed',
            //'password_confirmation'=>'required',
           // 'roles' => 'required',
        ]);
    }

    public function update(Request $request, $id)
    { 
        $this->validaruserUpdate($request);
        if((Persona::where('email',$request->correo)->where('id',$id)->count())>0){
            $updatepersona=$this->updatepersona( $request, $id);
            return response()->json($updatepersona);
        }else{
            if((Persona::where('email',$request->correo)->count())>0){
                return '1';
            }else{
                $updatepersona=$this->updatepersona( $request, $id);
                return response()->json($updatepersona);
            }   
         }  
    }

    public function updatepersona(Request $request, $id){
        try{
            $persona = Persona::findOrFail($id);
            $persona->tipDoc=$request->tipodoc['num'];
            $persona->nom = $request->nombresuser;
            $persona->apePat = $request->apePat;
            $persona->apeMat = $request->apeMat;
            $persona->gen = $request->genero;
            //$persona->dom = $request->direccion;
            $persona->email = $request->correo;
           // $persona->tipDoc = $request->tipoDoc;
            $persona->numDoc = $request->userdoc;
            //$persona->fecNac = $request->nacimiento;
            $persona->grad_estud = $request->gradoestu;
            $persona->abre_grad = $request->gradoabr;
            //$persona->numCel = $request->celular;
           // $persona->espe=$request->escuela['ID_ESC'];
            $persona->cod_alum=$request->codalum;
            $persona->save();
            if( count($request->roles)>0){
                $rolesupdate=$this->agregarroles($persona->id,  $request->roles); 
            }                          
            
            $usuario = User::where('persona_id', $persona->id)->first();
            $usuario->email = $request->correo;
            $usuario->email_verified_at=now();
            $usuario->password = Hash::make($request->userdoc);
            $usuario->save();
           
            return response()->json('actualizado');
        }catch(Exception){
            return '2';
        }

    }


     /*public function actualizarroles($id_per, $roles,$facu,$escu){
        $personarol=PersonaRole::where('persona_id',$id_per)->delete();
            if($personarol){
                foreach ($roles as $rol ) {
                    $roles=PersonaRole::create([              
                        'estado'=>1,
                        'persona_id'=>$id_per,
                        'facId'=>$facu ? $facu['FACULTAD_ID']:null,
                        'escId'=> $escu ? $escu['ID_ESC']:null,
                        'rol_id'=>$rol['id'],
                    ]); 
                }
                return $roles;
     
            }

     }*/
    protected function disablerol($id){
        $rol=13;
        if($rol==13){
            PersonaRole::where('id',$id)->update(['estado'=>0]);
            return 1;
        }else{
            return 'user no autorizado';
        }
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
