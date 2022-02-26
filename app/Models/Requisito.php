<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function FaseRolRequisito()
    {
        return $this->hasMany(FaseRolRequisito::class,'requisito_id','id');
    }
    public function TipoArchivo()
    {
        return $this->belongsTo(TipoArchivo::class,'tipoarchi_id','id');
    }
}
