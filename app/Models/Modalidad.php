<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modalidad extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Proceso()
    {
        return $this->hasMany(Proceso::class,'moda_id','id');
    }
}
