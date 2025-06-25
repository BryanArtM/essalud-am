<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Riesgo extends Model
{
    use HasFactory;
    protected $fillable = [
        'adulto_mayor_id',
        'sobrepeso',
        'sedentarismo',
        'tabaco',
        'alcohol',
        'estres',
        'bajo_peso',
        'perimetro_abdominal_aumentado',
        'hdl_bajo'
    ];

    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }

}
