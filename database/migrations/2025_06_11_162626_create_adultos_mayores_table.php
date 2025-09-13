<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LOS ADULTOS MAYORES
        Schema::create('adultos_mayores', function (Blueprint $table) {
            $table->id();
            $table->string('ipress');
            $table->string('numero_ficha');
            $table->string('apellidos');
            $table->string('nombres');
            $table->string('dni')->unique();
            $table->string('telefono')->nullable();
            $table->date('fecha_ingreso');
            $table->date('fecha_nacimiento');
            $table->text('alergias')->nullable();
            $table->string('adulto_mayor_fragil')->nullable(); 
            $table->index(['apellidos', 'nombres']);
            $table->timestamps();
        });




    }

        public function down(): void
    {
        Schema::dropIfExists('adultos_mayores');
    }
};
