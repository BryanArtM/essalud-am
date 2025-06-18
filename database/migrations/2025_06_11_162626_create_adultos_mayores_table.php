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
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LOS ADULTOS MAYORES
        Schema::create('adultos_mayores', function (Blueprint $table) {
            $table->id();
            $table->string('ipress');
            $table->string('numero_ficha');
            $table->string('nombre');
            $table->string('dni')->unique();
            $table->string('telefono')->nullable();
            $table->date('fecha_ingreso');
            $table->date('fecha_nacimiento'); // Fecha de nacimiento del adulto mayor (CALCULAR EDAD)
            $table->text('alergias')->nullable();
            $table->string('adulto_mayor_fragil')->nullable(); //REVISAR SI SE DEBE CAMBIAR A BOOLEAN O NUMBER
            $table->timestamps();
        });




    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adultos_mayores');
    }
};
