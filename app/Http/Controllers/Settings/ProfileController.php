<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use Illuminate\Http\Request;

class ProfileController extends Controller
{

    public function update(Request $request)
    {
        
        $user = $request->user();

        $this->validate($request, [
            'nombre' => 'required',
            'apellido1' => 'required',
            'apellido2' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);
        $persona=$user->persona;
        $persona->nom=$request->nombre;
        $persona->apePat=$request->apellido1;
        $persona->apeMat=$request->apellido2;
        $persona->save();

       
       // $persona->update($request->only('nombre','apellido1','apellido2'));
        $user->update($request->only('email'));
        return response()->json($user);
    }
}
