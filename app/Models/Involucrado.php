<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Involucrado extends Model
{
    use HasFactory;
    protected $fillables=[


    ];
    
    public function Trabajo()
    {
        return $this->belongsTo(Trabajo::class,'trabajo_id','id');
    }

    public function PersonaRol()
    {
        return $this->belongsTo(PersonaRol::class,'persrol_id','id');
    }
}
