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
        return $this->hasMany(Tramite::class,'proceso_id','id');
    }

    public function Fase()
    {
        return $this->hasMany(Fase::class,'proceso_id','id');
    }

    public function Modalidad()
    {
        return $this->belongsTo(Modalidad::class,'moda_id','id');
    }

    public function Grado()
    {
        return $this->belongsTo(Grado::class,'grado_id','id');
    }
}