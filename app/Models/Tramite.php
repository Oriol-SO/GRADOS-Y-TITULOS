<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function Persona()
    {
        return $this->belongsTo(Persona::class,'persona_id','id');
    }

    public function Diploma()
    {
        return $this->hasOne(Diploma::class,'tramite_id','id');
    }

    public function Resolucion()
    {
        return $this->belongsTo(Resolucion::class,'resolucion_id','id');
    }

    public function Consejo()
    {
        return $this->belongsTo(Consejo::class,'consejo_id','id');
    }

    public function Proceso()
    {
        return $this->belongsTo(Proceso::class,'proceso_id','id');
    }

    public function Trabajo()
    {
        return $this->belongsTo(Trabajo::class,'trabajo_id','id');
    }

    public function File()
    {
        return $this->hasMany(File::class,'tramite_id','id');
    }
}
