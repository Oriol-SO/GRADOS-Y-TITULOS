<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Persona extends Model
{
    use HasFactory;
    protected $fillable=[
        'nom',
        'apePat',
        'apeMat',
        'gen',
        'dom',
        'email',
        'tipDoc',
        'numDoc',
        'fecNac',
        'numcel',
        'grad_estud',
        'abre_grad',
        'espe',
        'facu',
        'cod_alum',
        'curri',
        'fec_matri',
        'fec_egre',
    ];
    
    public function PersonaRole(){
        return $this->hasMany(PersonaRole::class,'persona_id','id');
    }

    public function User()
    {
        return $this->hasOne(User::class,'persona_id','id');
    }

    public function Tramite(){
        return $this->hasMany(Tramite::class,'persona_id','id');
    }



}


