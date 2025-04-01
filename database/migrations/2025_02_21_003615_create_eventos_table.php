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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->time('hora');
            $table->foreignId('pacientes_id')->constrained()->onDelete('cascade');
            $table->foreignId('especialidades_id')->constrained()->onDelete('cascade');
            $table->text('descripcion');
            $table->date('fecha');
            $table->string('color')->default('#ff0000'); // color por defecto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
