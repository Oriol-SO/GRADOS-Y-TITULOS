<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grado extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Proceso()
    {
        return $this->hasMany(Proceso::class,'grado_id','id');
    }

    public function Denominacion()
    {
        return $this->hasMany(Denominacion::class,'grado_id','id');
    }
}
