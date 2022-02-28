<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function PersonaRol()
    {
        return $this->hasMany(PersonaRole::class,'rol_id','id');
    }
    //CONECION CON LA MISMA TABLA ROL
    public function Rol()
    {
        return $this->hasMany(Role::class,'rol_id','id');
    }
    public function FaseRolRequisito(){
        return $this->hasMany(FaseRolRequisito::class,'rol_id','id');
  
    }

}