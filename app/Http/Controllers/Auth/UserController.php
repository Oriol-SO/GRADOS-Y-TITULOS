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
        );
        return response()->json($datosUser);
        

    }
}
