<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Models\PersonaRole;
class SecretariaFacultadMiddleware
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
        $roles=[];
        PersonaRole::where('persona_id',auth()->user()->persona_id)->where('estado',1)->get()->map(function($r)use(&$roles){
            $roles[]= $r->rol_id;
        });      
        if(auth()->check() && in_array(5, $roles)){
            return $next($request);
        }else{

            return redirect(RouteServiceProvider::HOME);
        }
    }
}
