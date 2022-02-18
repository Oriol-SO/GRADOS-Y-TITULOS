<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function Involucrado()
    {
        return $this->hasMany(Involucrado::class);
    }

    public function LineaInvestigacion()
    {
        return $this->belongsTo(LineaInvestigacion::class);
    }

    public function Tramite()
    {
        return $this->hasMany(Tramite::class);
    }
}
