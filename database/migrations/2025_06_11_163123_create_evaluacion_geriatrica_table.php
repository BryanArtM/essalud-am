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
        Schema::create('evaluacion_geriatrica', function (Blueprint $table) {
            $table->id();
            $table->foreignId('adulto_mayor_id')->constrained('adultos_mayores')->onDelete('cascade');
            $table->boolean('autovalente')->default(true);
            $table->string('test_barber')->nullable();
            $table->string('test_barthel')->nullable();
            $table->string('test_lawton_brody')->nullable();
            $table->string('test_katz')->nullable();
            $table->boolean('fragil')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion_geriatrica');
    }
};
