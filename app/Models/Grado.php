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
        return $this->hasMany(Proceso::class);
    }

    public function Denominacion()
    {
        return $this->hasMany(Denominacion::class);
    }
}
