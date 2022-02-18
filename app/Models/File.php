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
        return $this->belongsTo(Tramite::class,'tramite_id','id');
    }

    public function PersonaRol()
    {
        return $this->belongsTo(PersonaRol::class,'persrol_id','id');
    }

    public function Revision()
    {
        return $this->hasMany(Revision::class,'file_id','id');
    }

    public function Observacion()
    {
        return $this->hasMany(Observacion::class,'file_id','id');
    }

    public function FaseRolRequisito()
    {
        return $this->belongsTo(FaseRolRequisito::class,'faserolreq_id','id');
    }
}
