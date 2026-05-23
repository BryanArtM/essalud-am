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
        // Crear tabla ipress
        Schema::create('ipress', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_ipress', 20)->unique()->comment('Código único de IPRESS');
            $table->string('nombre', 255)->comment('Nombre del establecimiento de salud');
            $table->string('distrito', 100)->nullable()->comment('Distrito donde se ubica');
            $table->string('provincia', 100)->nullable()->comment('Provincia donde se ubica');
            $table->string('departamento', 100)->default('Ancash')->comment('Departamento');
            $table->boolean('activo')->default(true)->comment('Estado del registro');
            $table->timestamps();
        });

        // Agregar relación con ipress en tabla adultos_mayores
        Schema::table('adultos_mayores', function (Blueprint $table) {
            $table->foreignId('ipress_id')->nullable()->after('numero_ficha')->constrained('ipress')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Eliminar relación con ipress
        Schema::table('adultos_mayores', function (Blueprint $table) {
            $table->dropForeign(['ipress_id']);
            $table->dropColumn('ipress_id');
        });

        // Eliminar tabla ipress
        Schema::dropIfExists('ipress');
    }
};
