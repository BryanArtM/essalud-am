<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdultoMayor extends Model
{
    use HasFactory;
    protected $table = 'adultos_mayores'; // nombre correcto de la tabla 


    public function enfermedades() {
        return $this->hasOne(Enfermedad::class);
    }

    public function riesgos() {
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

    public function evaluacionGeriatrica() {
        return $this->hasOne(EvaluacionGeriatrica::class);
    }

    public function valoraciones() {
        return $this->hasMany(Valoracion::class);
    }

        public function actividadEducativa() {
        return $this->hasMany(ActividadEducativa::class);
    }

}

