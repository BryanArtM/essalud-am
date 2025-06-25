<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActividadEducativa extends Model
{
    use HasFactory;
    protected $table = 'actividades_educativas';
    protected $fillable = [
        'adulto_mayor_id',
        'fecha',
        'numero_sesion',
    ];

    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }
}
