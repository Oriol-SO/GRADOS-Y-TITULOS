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
           
            'email' => 'required|email|unique:users,email,'.$user->id,
            'Ncelular' => 'required',
            'Direccion' => 'required',
            'Egreso' => 'required',
            'Nacimiento' => 'required',
            'GradoEstudios' => 'required',
            'Abreviatura' => 'required',
            'Documento' => 'required',

        ]);
        $persona=$user->persona;
        $persona->email=$request->email;
        $persona->numcel=$request->Ncelular;
        $persona->dom=$request->Direccion;
        $persona->nom=$request->Egreso;
        $persona->fecNac=$request->Nacimiento;
        $persona->grad_estud=$request->GradoEstudios;
        $persona->abre_grad=$request->Abreviatura;
        $persona->numDoc=$request->Documento;
        
        $persona->save();

       
       // $persona->update($request->only('nombre','apellido1','apellido2'));
        $user->update($request->only('email'));
        return response()->json($user);
    }
}
