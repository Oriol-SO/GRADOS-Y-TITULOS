<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Persona;
use App\Models\PersonaRole;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * The user has been registered.
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }

        return response()->json($user);
    }

    protected function register( request $request ){
        
        $this->validaruser($request);

            try{
                $persona=Persona::create([
                    'nom'=>$request->nombresuser,
                    'apePat'=>$request->apePat,
                    'apeMat'=>$request->apeMat,
                    'gen'=>$request->genero,
                    'dom'=>$request->direccion?$request->direccion:null,
                    'email'=>$request->correo,
                    'tipDoc'=>$request->tipodoc['num'],
                    'numDoc'=>$request->userdoc,
                    'fecNac'=>$request->nacimiento?$request->nacimiento:null,
                    'numcel'=>$request->celular,
                    'grad_estud'=>$request->gradoestu,
                    'abre_grad'=>$request->gradoabr,
                    'espe'=>$request->escuela? $request->escuela['ID_ESC']:null,
                    'cod_alum'=>$request->codigo,
                    'curri'=>$request->curricula?$request->curricula:null,
                    'fec_matri'=>$request->fecha_ingre?$request->fecha_ingre:null,
                    'fec_egre'=>$request->fecha_egre,
                    
                ]);
                
                $rolesuser= PersonaRole::create([
                    'estado'=>1,
                    'persona_id'=>$persona->id,
                    'facId'=>$request->facultad ? $request->facultad['FACULTAD_ID']:null,
                    'escId'=>$request->escuela? $request->escuela['ID_ESC']:null,
                    'rol_id'=>'10',
                ]); 
                $user=User::create([
                    'name'=>$request->nombresuser,
                    'email'=>$request->correo,
                    'password'=>Hash::make($request->password),
                    'persona_id'=>$persona->id,
                ]);    
                return response()->json([
                    'persona'=>$persona,
                    'roles'=>$rolesuser,
                    'user'=>$user,
                ]);
            }catch(QueryException $e){
                return $e;
            }
        
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validaruser($request=null)
    {
        return $request->validate([
            'userdoc' => 'required|numeric',
            'apeMat' => 'required',
            'apePat'=> 'required',
            'nombresuser' => 'required',
            'genero' => 'required|max:1',

            //'nacimiento' => 'required|date',
            'correo' =>'required|email|unique:users,email',
            'celular' => 'required|numeric',
            'gradoestu' => 'required',
            'gradoabr' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation'=>'required',
            'fecha_egre' => 'required|numeric',
            'facultad'=> 'required',
            'escuela'=> 'required',
            'codigo'=> 'required|numeric|unique:personas,cod_alum',    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function datosusuario($codigo){    
                $response = Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/'.$codigo);
                
                return $response;        
    }
}
