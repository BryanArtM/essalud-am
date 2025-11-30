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
        'control_renal_fecha',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check()) {
                $model->created_by = auth()->id();
                $model->updated_by = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (auth()->check()) {
                $model->updated_by = auth()->id();
            }
        });
    }
    //LAS TALLAS SE DEBEN AGREGAR EN CADA REGISTRO

    public function adultoMayor() {
        return $this->belongsTo(AdultoMayor::class);
    }

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy() {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
