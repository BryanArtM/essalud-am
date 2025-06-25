<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdultoMayor extends Model
{
    use HasFactory;
    protected $table = 'adultos_mayores'; // FORZAR NOMBRE DE LA TABLA
    protected $fillable = [
        'numero_ficha',
        'ipress',
        'nombres',
        'apellidos',
        'dni',
        'telefono',
        'fecha_nacimiento',
        'fecha_ingreso',
        'alergias',
        'adulto_mayor_fragil',
    ];

    public function enfermedad() {
        return $this->hasOne(Enfermedad::class);
    }

    public function riesgo() {
        return $this->hasOne(Riesgo::class);
    }

    public function evaluaciones() {
        return $this->hasMany(Evaluacion::class);
    }

    public function citas() {
        return $this->hasMany(Cita::class);
    }

    public function tratamientos() {
        return $this->hasMany(Tratamiento::class);
    }

    public function valoraciones() {
        return $this->hasMany(Valoracion::class);
    }

    public function actividadesEducativas() {
        return $this->hasMany(ActividadEducativa::class);
    }

}

