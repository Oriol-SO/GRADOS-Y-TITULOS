<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function PersonaRol()
    {
        return $this->hasMany(PersonaRol::class);
    }
}