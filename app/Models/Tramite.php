<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;
    protected $fillable=[
        'fec_inicio',
        'fec_fin',
        'fecha_vencimiento',
        'modo_obtencion',
        'tipo_tramite',
        'fase_actual',
        'estado',
        'trabajo_id',
        'persona_id',
        'proceso_id',
        'consejo_id',
        'resolucion_id',
        'receptor_rol_notify',

    ];

    public function Persona()
    {
        return $this->belongsTo(Persona::class,'persona_id','id');
    }

    public function Diploma()
    {
        return $this->hasOne(Diploma::class,'tramite_id','id');
    }

    public function Resolucione()
    {
        return $this->belongsTo(Resolucione::class,'resolucion_id','id');
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
