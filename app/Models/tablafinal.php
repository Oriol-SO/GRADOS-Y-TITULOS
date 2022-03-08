<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tablafinal extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function tablainicio()
    {
        return $this->belongsTo(tablainicio::class,'Bini_id','id');
    }
}
