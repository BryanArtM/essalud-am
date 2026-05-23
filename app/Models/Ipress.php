<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ipress extends Model
{
    use HasFactory;

    protected $table = 'ipress';

    protected $fillable = [
        'codigo_ipress',
        'nombre',
        'distrito',
        'provincia',
        'departamento',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    // Relación con adultos mayores
    public function adultosMayores()
    {
        return $this->hasMany(AdultoMayor::class, 'ipress_id');
    }

    // Scope para IPRESS activos
    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }

    // Accessor para mostrar información completa
    public function getInfoCompletaAttribute()
    {
        return "{$this->codigo_ipress} - {$this->nombre}";
    }
}
