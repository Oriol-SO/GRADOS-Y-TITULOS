<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    use HasFactory;
    protected $fillable=[
        'modo_sustentacion',
        'url_repositorio',
        'nombre',
        'lineainv_id',
        'fecha_sustentacion',

    ];

    public function Involucrado()
    {
        return $this->hasMany(Involucrado::class,'trabajo_id','id');
    }

    public function LineaInvestigacion()
    {
        return $this->belongsTo(LineaInvestigacion::class,'lineainv_id','id');
    }

    public function Tramite()
    {
        return $this->hasMany(Tramite::class,'trabajo_id','id');
    }
}
