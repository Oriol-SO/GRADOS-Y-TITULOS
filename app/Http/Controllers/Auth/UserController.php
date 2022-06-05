<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Persona;
use App\Models\PersonaRole;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     */
    public function current(Request $request)
    {
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
        

    }
}
