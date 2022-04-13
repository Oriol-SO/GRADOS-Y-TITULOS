<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Persona;
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

        );
        return response()->json($datosUser);
        

    }
}
