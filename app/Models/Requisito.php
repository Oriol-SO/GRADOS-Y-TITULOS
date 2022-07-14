<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisito extends Model
{
    use HasFactory;
    protected $fillable=[
        'nombre',
        'tipo_documento',
        'html_formate',
        'tipoarchi_id',
        'tipo_requisito'

    ];
    public function FaseRolRequisito()
    {
        return $this->hasMany(FaseRolRequisito::class,'requisito_id','id');
    }
    public function TipoArchivo()
    {
        return $this->belongsTo(TipoArchivo::class,'tipoarchi_id','id');
    }
}
