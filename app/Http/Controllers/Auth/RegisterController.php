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

    public $correo='alguien@undac.edu.pe';
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('messages.sent'),'correo'=>$this->correo]);
        }
        
        return response()->json($user);
    }

    protected function register( Request $request ){
        
        $this->validaruser($request);
        $codAlu=$request->codAlu;
        $date= $this->datosusuario($codAlu);
        $curricula=$date['Curricula'];
        $curri= $this->curricula($curricula);
        $school= $this->escuela($curri);
        //  return $school[0]->FACULTAD_ID;
        $g=1;
        if ($date['Genero']=='F') {
            $g=0;
        }
        try{
            $persona=Persona::create([

                'nom' => $date['Nombres'],
                'apePat' =>  $date['Apellido paterno'],
                'apeMat' =>  $date['Apellido materno'],
                'gen' => $g,
                'dom' =>  $date['Domicilio']?$date['Domicilio']:'',
                'email' => $date['Correo Institucional'],
                'tipDoc' => '1',
                'numDoc' =>  $date['Dni'],
                'fecNac' =>  $date['Fecha de nacimiento'],            
                'numCel' => '99999999',
                'espe' => $school[0]->ID_ESC,
                'cod_alum'=>  $codAlu,  
                'curri'=> $curricula, 
                'fec_matri'=>$date['Fecha de Ingreso'],
                'grad_estud'=>"",
                'abre_grad'=>"",
            ]);  
            $rolesuser= PersonaRole::create([
                'estado'=>1,
                'persona_id'=>$persona->id,
                'facId'=>$school[0]->FACULTAD_ID,
                'escId'=>$school[0]->ID_ESC,
                'rol_id'=>'10',
            ]); 
            $user=User::create([
                'name'=>$date['Nombres'],
                'email'=>$date['Correo Institucional'],
                'password'=>Hash::make($request->password),
                'persona_id'=>$persona->id,
            ]);    
            return response()->json([
                'persona'=>$persona,
                'roles'=>$rolesuser,
                'user'=>$user,]);
        }catch(QueryException $e){
            return 'error conex';} 
        
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validaruser($request=null)
    {
        return $request->validate([
            
            'password' => 'required|confirmed',
            'password_confirmation'=>'required',
            'codAlu'=> 'required|numeric|unique:personas,cod_alum',    
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
                try{
                    $response = Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/'.$codigo);
                    return $response;
                    
                    
                }catch (Exception){
                     return 'error de conexion';
                }                     
    }
    public function curricula($codigo){    
        try{
            $escuelas = Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/curricula');
            $escuela="";
            $escuelas=json_decode($escuelas);
            foreach($escuelas as $escu){
                if($escu->CURRICULA==$codigo){
                    $escuela=$escu->ESCUELA;
                }
            }
                return $escuela;
            
        }catch (Exception){
             return 'error de conexion';
        }                     
}
    public function escuela($codigo){    
        try{
            $escuelas=Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/school');
            $escuela=array();
            $escuelas=json_decode($escuelas);
            foreach($escuelas as $escu){
                if($escu->ID_ESC==$codigo){
                    $escuela[]=$escu;
                }
            }
                return $escuela;
            
        }catch (Exception){
             return 'error de conexion';
        }                     
    }
    
}
