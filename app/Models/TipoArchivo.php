<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoArchivo extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Requisito()
    {
        return $this->hasMany(Requisito::class,'tipoarchi_id','id');
    }
}
