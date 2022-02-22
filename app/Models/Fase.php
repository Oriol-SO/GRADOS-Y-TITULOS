<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fase extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Proceso()
    {
        return $this->belongsTo(Proceso::class,'proceso_id','id');
    }

    public function FaseRolRequisito()
    {
        return $this->hasMany(FaseRolRequisito::class,'fase_id','id');
    }
    //CONECION CON LA MISMA TABLA FASE
    public function Fase()
    {
        return $this->hasMany(Fase::class,'fase_id','id');
    }
}