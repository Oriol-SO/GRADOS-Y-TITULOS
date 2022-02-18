<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denominacion extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function Grado()
    {
        return $this->belongsTo(Grado::class);
    }
}
