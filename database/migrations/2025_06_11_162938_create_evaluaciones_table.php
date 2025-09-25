<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
        public function up(): void
    {
        // CREACIÓN DE LA TABLA CON LOS DATOS DE LAS EVALUACIONES DE LOS ADULTOS MAYORES
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->integer('talla')->nullable();
            $table->decimal('peso_aceptable', 5, 2)->nullable();
            $table->decimal('peso', 5, 2)->nullable();
            $table->string('presion_arterial')->nullable();
            $table->decimal('glucosa', 5, 2)->nullable();
            $table->decimal('hb_glicosilada', 5, 2)->nullable();
            $table->decimal('imc', 5, 2)->nullable();
            $table->decimal('perimetro_abdominal', 5, 2)->nullable();
            $table->string('evaluacion_pie_dm')->nullable();
            $table->enum('test_morisky_green', ['cumple', 'no cumple'])->nullable();
            $table->boolean('vacuna_influenza')->default(false);
            $table->boolean('vacuna_neumococo')->default(false);
            $table->decimal('microalbuminuria', 5, 2)->nullable();
            $table->decimal('creatinina', 5, 2)->nullable();
            $table->decimal('tasa_albuminuria_creatinuria', 5, 2)->nullable();
            $table->decimal('tasa_filtracion_glomerular', 5, 2)->nullable();
            $table->date('control_renal_fecha')->nullable();
            $table->timestamps();
        });
    }

        public function down(): void
    {
        Schema::dropIfExists('evaluaciones');
    }
};
