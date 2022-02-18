<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function Tramite()
    {
        return $this->hasMany(Tramite::class);
    }

    public function Fase()
    {
        return $this->hasMany(Fase::class);
    }

    public function Modalidad()
    {
        return $this->belongsTo(Modalidad::class);
    }

    public function Grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
