<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
    use HasFactory;
    protected $fillables=[


    ];
    
    public function File(){
        return $this->belongsTo(File::class,'file_id','id');
    }
}
