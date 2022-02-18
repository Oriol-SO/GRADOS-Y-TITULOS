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
        return $this->belongsTo(Persona::class);
    }

    public function Diploma()
    {
        return $this->hasOne(Diploma::class);
    }

    public function Resolucion()
    {
        return $this->hasOne(Resolucion::class);
    }

    public function Consejo()
    {
        return $this->hasOne(Consejo::class);
    }

    public function Proceso()
    {
        return $this->belongsTo(Proceso::class);
    }

    public function Trabajo()
    {
        return $this->belongsTo(Trabajo::class);
    }

    public function File()
    {
        return $this->hasMany(File::class);
    }
}
