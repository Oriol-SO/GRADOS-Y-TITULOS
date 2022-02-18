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
}
