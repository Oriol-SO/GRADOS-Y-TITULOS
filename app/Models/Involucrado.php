<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Involucrado extends Model
{
    use HasFactory;
    protected $fillable=[
        'trabajo_id',
        'persrol_id',
        'rol_id',
        'estado'

    ];
    
    public function Trabajo()
    {
        return $this->belongsTo(Trabajo::class,'trabajo_id','id');
    }

    public function PersonaRole()
    {
        return $this->belongsTo(PersonaRole::class,'persrol_id','id');
    }
}
