<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LAS CITAS DE LOS ADULTOS MAYORES
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->date('fecha')->nullable();
            $table->string('medico')->nullable();
            $table->string('enfermera')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamps();
        });
        
    }

        public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
