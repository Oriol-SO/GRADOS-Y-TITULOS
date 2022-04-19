<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucione extends Model
{
    use HasFactory;
    protected $fillable=[
        'numero',
        'fecha',
        'estado',

    ];

    public function Tramite()
    {
        return $this->hasMany(Tramite::class,'resolucion_id','id');
    }
}
