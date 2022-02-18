<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Tramite()
    {
        return $this->belongsTo(Tramite::class);
    }

    public function PersonaRol()
    {
        return $this->belongsTo(PersonaRol::class);
    }

    public function Revision()
    {
        return $this->hasMany(Revision::class);
    }

    public function Observacion()
    {
        return $this->hasMany(Observacion::class);
    }

    public function FaseRolRequisito()
    {
        return $this->belongsTo(FaseRolRequisito::class);
    }
}
