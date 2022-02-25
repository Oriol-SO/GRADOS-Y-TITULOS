<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    protected $fillables=[
        

    ];
    
    public function PersonaRol(){
        return $this->hasMany(PersonaRol::class,'persona_id','id');
    }

    public function User()
    {
        return $this->hasOne(User::class,'persona_id','id');
    }

    public function Tramite(){
        return $this->hasMany(Tramite::class,'persona_id','id');
    }



}


