<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function Tramite()
    {
        return $this->hasMany(Tramite::class,'resolucion_id','id');
    }
}
