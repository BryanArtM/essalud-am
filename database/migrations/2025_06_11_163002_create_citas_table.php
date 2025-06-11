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
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LAS CITAS DE LOS ADULTOS MAYORES
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->date('fecha');
            $table->string('medico')->nullable();
            $table->string('enfermera')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
