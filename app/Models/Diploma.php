<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diploma extends Model
{
    use HasFactory;
    protected $fillable=[

        'tramite_id',
        'num_lib',
        'num_lib_regis',
        'lib_foli',
        'num_sticker',
        'fec_hor_entre',
        'num_info_vice',

    ];

    public function Tramite(){

        return $this->belongsTo(Tramite::class,'tramite_id','id');

    }
}
