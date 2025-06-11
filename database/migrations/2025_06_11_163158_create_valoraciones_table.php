<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->date('fecha');
            $table->enum('servicio', ['Enfermeria', 'Medicina', 'Nutricion', 'Psicologia', 'Servicio Social', 'Visita Domiciliaria']);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valoraciones');
    }
};
