<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        Schema::create('valoraciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->boolean('autovalente')->default(true);
            $table->string('test_barber')->nullable();
            $table->string('test_barthel')->nullable();
            $table->boolean('fragil')->default(false);
            $table->string('test_lawton_brody')->nullable();
            $table->string('test_katz')->nullable();

            $table->date('fecha_enfermeria')->nullable();
            $table->date('fecha_medicina')->nullable();
            $table->date('fecha_nutricion')->nullable();
            $table->date('fecha_psicologia')->nullable();
            $table->date('fecha_servicio_social')->nullable();
            $table->date('fecha_visita_domiciliaria')->nullable();
            $table->timestamps();
        });
        
    }

        public function down(): void
    {
        Schema::dropIfExists('valoraciones');
    }
};
