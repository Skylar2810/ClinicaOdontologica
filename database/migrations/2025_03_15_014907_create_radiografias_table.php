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
        Schema::create('radiografias', function (Blueprint $table) {
            $table->id();  // ID único de la radiografía
            $table->unsignedBigInteger('paciente_id');  // Relación con el paciente
            $table->string('imagen');  // Ruta de la imagen (almacenada en el disco)
            $table->text('descripcion')->nullable();  // Descripción opcional de la radiografía
            $table->timestamps();  // Tiempos de creación y actualización
        
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('radiografias');
    }
};
