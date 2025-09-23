<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluacion extends Model
{
    use HasFactory;
    protected $table = 'evaluaciones';
    protected $fillable = [
        'adulto_mayor_id',
        'talla',
        'peso_aceptable',
        'peso',
        'presion_arterial',
        'glucosa',
        'hb_glicosilada',
        'imc',
        'perimetro_abdominal',
        'evaluacion_pie_dm',
        'test_morisky_green',
        'vacuna_influenza',
        'vacuna_neumococo',
        'microalbuminuria',
        'creatinina',
        'tasa_albuminuria_creatinuria',
        'tasa_filtracion_glomerular',
        'control_renal_fecha'
    ];
    //LAS TALLAS SE DEBEN AGREGAR EN CADA REGISTRO

    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }
}
