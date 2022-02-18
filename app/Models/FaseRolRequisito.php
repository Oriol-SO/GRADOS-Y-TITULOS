<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaseRolRequisito extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Fase()
    {
        return $this->belongsTo(Fase::class);
    }

    public function Requisito()
    {
        return $this->belongsTo(Requisito::class);
    }


    //Conecion con Roles falta


    public function File()
    {
        return $this->hasMany(File::class);
    }
}
