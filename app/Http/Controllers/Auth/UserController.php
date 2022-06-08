<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Persona;
use App\Models\PersonaRole;
use Exception;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     */
    public function current(Request $request)
    {
        try{

      
        $user=$request->user();
        $persona=$user->persona;

        $datosUser=array(
            //'role'=>(PersonaRole::where('persona_id',$persona->id)->first())->rol_id,
            'role'=>PersonaRole::where('persona_id',$persona->id)->where('estado',1)->where('uso',1)->get()->map(function($r){
               return $r->rol_id;
            }),
            'email'=>$user->email,
            'nombre'=>$persona->nom,
            'apellido1'=>$persona->apePat,
            'apellido2'=>$persona->apeMat,
            'genero'=>$persona->gen,
            'curricula'=>$persona->curri,
            'matricula'=>$persona->fec_matri,
            'Direccion'=>$persona->dom,
            'Codigo'=>$persona->cod_alum,
            'Ncelular'=>$persona->numcel,
            'Nacimiento'=>$persona->fecNac,
            'GradoEstudios'=>$persona->grad_estud,
            'Abreviatura'=>$persona->abre_grad,
            'Egreso'=>$persona->fec_egre,
            'tipoDocumento'=>['nombre'=>'','num'=>$persona->tipDoc],
            'Documento'=>$persona->numDoc,
            'Roles'=>PersonaRole::where('persona_id',$persona->id)->get()->map(function($r){
                return[
                    'id'=>$r->id,
                    'rol_id'=>$r->rol_id,
                    'nombre'=>$r->rol->rolNombre,
                ] ;
             }),

        );
        return response()->json($datosUser);
        
        }catch(Exception $e){
            return $e;
        }
    }

    public function cambiar_rol($id, Request $request){
        try{
            $request->validate([
                'id_role'=>'required',
            ]);
            if($request->id_role==$id){
                //actualizar uso de roles
                $per_role=PersonaRole::where('id',$id)->where('estado',1)->count();
                if($per_role>0){
                    //ponemos en primer lugar tods en desuso
                    PersonaRole::where('persona_id',$request->user()->persona_id)->update(['uso'=>0]);
                    //actualizamos solo el rol seleccionado
                    $personaRole=PersonaRole::where('id',$id)->first();
                    $personaRole->uso=1;
                    $personaRole->save();
                    //$new_rol=PersonaRole::where('id',)
                    return $personaRole->rol_id;
                }else{
                    return 'ROL_DESACTIVADO'; 
                }
            }else{
                return 'ERROR_ROL';
            }
        }catch(Exception $e){
            return $e;
        }
    }

}
