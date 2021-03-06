<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consejo extends Model
{
    use HasFactory;
    protected $fillable=[
        'numero',
        'fecha',
        'estado',
        'num_oficio',
    ];

    public function Tramite()
    {
        return $this->hasMany(Tramite::class,'consejo_id','id');
    }
}
