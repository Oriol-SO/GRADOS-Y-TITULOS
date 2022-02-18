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
        return $this->belongsTo(Rol::class);
    }

    public function Persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function Involucrado()
    {
        return $this->hasmany(Involucrado::class);
    }

    public function File()
    {
        return $this->hasmany(File::class);
    }

}
