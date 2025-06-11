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
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LOS RIESGOS DE LOS ADULTOS MAYORES
        Schema::create('riesgos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->boolean('sobrepeso')->default(false);
            $table->boolean('sedentarismo')->default(false);
            $table->boolean('tabaco')->default(false);
            $table->boolean('alcohol')->default(false);
            $table->boolean('estres')->default(false);
            $table->boolean('bajo_peso')->default(false);
            $table->boolean('perimetro_abdominal_aumentado')->default(false);
            $table->boolean('hdl_bajo')->default(false);
            $table->timestamps();
});


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('riesgos');
    }
};
