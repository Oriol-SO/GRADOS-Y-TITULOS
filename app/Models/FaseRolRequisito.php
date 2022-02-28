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
        return $this->belongsTo(Fase::class,'fase_id','id');
    }

    public function Requisito()
    {
        return $this->belongsTo(Requisito::class,'requisito_id','id');
    }


    //Conecion con Roles falta


    public function File()
    {
        return $this->hasMany(File::class,'faserolreq_id','id');
    }

    public function Rol(){
        return $this->belongsTo(Role::class,'rol_id','id');
 
    }
}
