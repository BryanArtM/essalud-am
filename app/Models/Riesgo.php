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
        'hdl_bajo',
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
