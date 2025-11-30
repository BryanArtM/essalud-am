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
