<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaRol extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function Rol()
    {
        return $this->belongsTo(Rol::class,'rol_id','id');
    }

    public function Persona()
    {
        return $this->belongsTo(Persona::class,'persona_id','id');
    }

    public function Involucrado()
    {
        return $this->hasmany(Involucrado::class,'persrol_id','id');
    }

   
    public function File()
    {
        return $this->hasmany(File::class,'persrol_id','id');
    }

}
