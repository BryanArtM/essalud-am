<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tratamiento extends Model
{
    use HasFactory;

    protected $fillable = [
        'adulto_mayor_id',
        'medicacion',
        'dosis',
    ];
    
    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }
}
