<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function Tramite(){

        return $this->belongsTo(Tramite::class,'tramite_id','id');

    }
}
