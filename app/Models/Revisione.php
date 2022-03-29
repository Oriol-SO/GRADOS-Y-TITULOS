<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revisione extends Model
{
    use HasFactory;
    protected $fillable=[

        'file_id',
        'persrol_id',
        'estado_id',
        'estado',
    ];

    public function File()
    {
        return $this->belongsTo(File::class,'file_id','id');
    }
    public function personarolFile()
    {
        return $this->belongsTo(File::class,'persrol_id','persrol_id');
    }

    public function Estado()
    {
        return $this->belongsTo(Estado::class,'estado_id','id');
    }
}
