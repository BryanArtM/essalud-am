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
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LAS ENFERMEDADES DE LOS ADULTOS MAYORES
        Schema::create('enfermedades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->boolean('obesidad')->default(false);
            $table->boolean('dislipidemia')->default(false);
            $table->boolean('hipertension_arterial')->default(false);
            $table->boolean('diabetes_mellitus')->default(false);
            $table->boolean('erc')->default(false);
            $table->boolean('osteoartrosis')->default(false);
            $table->boolean('asma')->default(false);
            $table->boolean('epoc')->default(false);
            $table->boolean('itg')->default(false);
            $table->boolean('sindrome_metabolico')->default(false);
            $table->text('otros')->nullable();
            $table->string('visare_numero')->nullable();
            $table->date('visare_fecha')->nullable();
            $table->string('estadio_1a_3a_numero')->nullable();
            $table->date('estadio_1a_3a_fecha')->nullable();
            $table->string('estadio_3b_5_numero')->nullable();
            $table->date('estadio_3b_5_fecha')->nullable();
            $table->timestamps();
        });



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfermedades');
    }
};
