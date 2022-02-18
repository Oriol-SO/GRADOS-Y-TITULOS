<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;
    protected $fillable=[


    ];

    public function File()
    {
        return $this->belongsTo(File::class);
    }

    public function Estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
