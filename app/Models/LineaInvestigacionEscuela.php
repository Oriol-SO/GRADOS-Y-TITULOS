<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaInvestigacionEscuela extends Model
{
    use HasFactory;
    protected $fillable=[


    ];
    public function LineaInvestigacion()
    {
        return $this->belongsTo(LineaInvestigacion::class,'lineainv_id','id');
    }
}
