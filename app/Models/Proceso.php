<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    use HasFactory;
    protected $fillable=[
        'procNom',
        'grado_id',
        'moda_id',
        'tipo',
        'estado',

    ];

    public function Tramite()
    {
        return $this->hasMany(Tramite::class,'proceso_id','id');
    }

    public function Fase()
    {
        return $this->hasMany(Fase::class,'proceso_id','id');
    }

    public function Modalidade()
    {
        return $this->belongsTo(Modalidade::class,'moda_id','id');
    }

    public function Grado()
    {
        return $this->belongsTo(Grado::class,'grado_id','id');
    }
}
