<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaRole extends Model
{
    use HasFactory;
    protected $fillable=[
 
        'fecIni',
        'fecFin',
        'estado' ,
        'persona_id',
        'facId',
        'escId',
        'rol_id', 
        'uso',
    ];

    public function Rol()
    {
        return $this->belongsTo(Role::class,'rol_id','id');
    }

    public function Persona()
    {
        return $this->belongsTo(Persona::class,'persona_id','id');
    }

    public function Involucrado()
    {
        return $this->hasmany(Involucrado::class,'persrol_id','id');
    }

   
    public function File()
    {
        return $this->hasmany(File::class,'persrol_id','id');
    }

}
