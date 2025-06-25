<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cita extends Model
{
    use HasFactory;
    protected $fillable = [
        'adulto_mayor_id',
        'fecha',
        'medico',
        'enfermera',
    ];


    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }
}
