<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Enfermedad extends Model
{
    use HasFactory;

    protected $table = 'enfermedades';
    protected $fillable = [
        'adulto_mayor_id',
        'obesidad',
        'dislipidemia',
        'hipertension_arterial',
        'diabetes_mellitus',
        'erc',
        'osteoartrosis',
        'asma',
        'epoc',
        'itg',
        'sindrome_metabolico',
        'otros',
        'visare_numero',
        'visare_fecha',
        'estadio_1a_3a_numero',
        'estadio_1a_3a_fecha',
        'estadio_3b_5_numero',
        'estadio_3b_5_fecha',
    ];
    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }

}
