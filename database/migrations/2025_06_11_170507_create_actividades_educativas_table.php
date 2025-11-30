<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        //CREACION DE LA TABLA  CON LAS ACTIVIDADES EDUCATIVAS DE LOS ADULTOS MAYORES
        Schema::create('actividades_educativas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->date('fecha')->nullable();
            $table->string('numero_sesion')->nullable(); 
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
 
            $table->timestamps();
        });
    }

        public function down(): void
    {
        Schema::dropIfExists('actividades_educativas');
    }
};
