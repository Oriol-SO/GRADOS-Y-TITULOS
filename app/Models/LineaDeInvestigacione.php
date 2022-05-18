<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineaDeInvestigacione extends Model
{
    use HasFactory;
    protected $fillable=[
        

    ];
    public function Trabajo()
    {
        return $this->hasMany(Trabajo::class,'lineainv_id','id');
    }

    public function LineaInvestigacionEscuela()
    {
        return $this->hasMany(LineaInvestigacionEscuela::class,'lineainv_id','id');
    }
}
