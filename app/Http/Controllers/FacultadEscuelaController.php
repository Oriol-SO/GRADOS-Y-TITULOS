<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Mockery\Undefined;
use App\Models\Role;
use App\Models\PersonaRole;
use Illuminate\Support\Arr;

class FacultadEscuelaController extends Controller
{
  
    public function facultad(){
        $response=Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/faculty');
        
        return $response;
    }
    /**

    *
    */


    public function escuelas($codigo){
        
        $escuelas=Http::get('http://api.undac.edu.pe/tasks/a3945a7384cbdcd33f49e8f5b8ec29f5/91f33e2776c526b9cca723a63476f028/school');
        $escuela=array();
        $escuelas=json_decode($escuelas);
        foreach($escuelas as $escu){
            if($escu->FACULTAD_ID==$codigo){
                $escuela[]=$escu;
            }

        }

            return $escuela;
    }

    public function rolesgenerales($codigo){
        if($codigo==1){
            //rolesgenerales
            $roles=Role::whereIn('id', [1, 2, 3,11,12,13])->get()->map(function($r){
                return[
                    'id'=>$r->id,
                    'rolNombre'=>$r->rolNombre,
                ];
            });
            return response()->json($roles);
        }else if($codigo==2){
            //roles por facu
            $rolesF=Role::whereIn('id', [4,5,14])->get()->map(function($r){
                return[
                    'id'=>$r->id,
                    'rolNombre'=>$r->rolNombre,
                ];
            });

            return response()->json($rolesF);
        }else if($codigo==3){
            //roles por escuela
            $rolesE=Role::whereIn('id', [6,7,8,9,10])->get()->map(function($r){
                return[
                    'id'=>$r->id,
                    'rolNombre'=>$r->rolNombre,
                ];
            });


            return response()->json($rolesE);
        }

    }

}