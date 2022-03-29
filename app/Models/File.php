<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable=[
        'path',
        'tramite_id',
        'persrol_id',
        'faserolreq_id'
    ];
    public function Tramite()
    {
        return $this->belongsTo(Tramite::class,'tramite_id','id');
    }

    public function PersonaRole()
    {
        return $this->belongsTo(PersonaRole::class,'persrol_id','id');
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
