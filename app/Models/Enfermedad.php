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
        'estadio_1_3a_numero',
        'estadio_1_3a_fecha',
        'estadio_3b_5_numero',
        'estadio_3b_5_fecha',
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
