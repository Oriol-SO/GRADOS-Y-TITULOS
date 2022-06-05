<?php

namespace App\Http\Middleware;

use App\Models\PersonaRole;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //obtener roles de la persona
        
        $roles=[];
        PersonaRole::where('persona_id',auth()->user()->persona_id)->get()->map(function($r)use(&$roles){
            $roles[]= $r->rol_id;
        });      
        if(auth()->check() && in_array(13, $roles)){
            return $next($request);
        }else{

            return redirect(RouteServiceProvider::HOME);
        }
    }
}
