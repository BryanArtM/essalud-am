<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class AdultoMayor extends Model
{
    use HasFactory;
    protected $table = 'adultos_mayores'; // FORZAR NOMBRE DE LA TABLA
    protected $fillable = [
        'numero_ficha',
        'ipress',
        'ipress_id',
        'nombres',
        'apellidos',
        'dni',
        'telefono',
        'direccion',    //añadido
        'email',        //añadido
        'fecha_nacimiento',
        'fecha_ingreso',
        'alergias',
        'adulto_mayor_fragil',
        'created_by',
        'updated_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::id();
                $model->updated_by = Auth::id();
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->updated_by = Auth::id();
            }
        });
    }


    public function enfermedad()
    {
        return $this->hasOne(Enfermedad::class, 'adulto_mayor_id', 'id');
    }

    public function riesgo()
    {
        return $this->hasOne(Riesgo::class, 'adulto_mayor_id', 'id');
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function tratamientos()
    {
        return $this->hasMany(Tratamiento::class);
    }

    public function valoracion()
    {
        return $this->hasOne(Valoracion::class);
    }

    public function ipressEntidad()
    {
        return $this->belongsTo(Ipress::class, 'ipress_id');
    }

    public function actividadesEducativas()
    {
        return $this->hasMany(ActividadEducativa::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
