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
        return $this->hasMany(PersonaRol::class);
    }

    public function User()
    {
        return $this->hasOne(User::class);
    }

    public function Tramite(){
        return $this->hasMany(Tramite::class);
    }



}


