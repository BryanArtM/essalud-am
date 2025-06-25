<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Valoracion extends Model
{
    use HasFactory;
protected $table = 'valoraciones';
    protected $fillable = [
        'adulto_mayor_id',
        'autovalente',
        'test_barber',
        'test_barthel',
        'fragil',
        'test_lawton_brody',
        'test_katz',
        'fecha_enfermeria',
        'fecha_medicina',
        'fecha_nutricion',
        'fecha_psicologia',
        'fecha_servicio_social',
        'fecha_visita_domiciliaria',

    ];

    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }
}
