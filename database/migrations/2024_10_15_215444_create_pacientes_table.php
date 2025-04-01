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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombres', 200);
            $table->string('ci', 20);
            $table->string('edad',5); 
            $table->string('ocupacion', 50);
            $table->string('lugar', 100);
            $table->date('fechap');
            $table->string('telcel', 20);
            $table->string('correo', 100)->unique();
            $table->string('domicilio', 200);
            $table->string('nombresfamiliar', 200);
            $table->string('edadfamiliar',5); 
            $table->string('telcelfamiliar', 20); 
            $table->string('correofamiliar', 100)->unique();
            $table->string('tabaco')->nullable();
            $table->string('alcochol')->nullable();
            $table->string('alergia')->nullable();
            $table->string('sed')->nullable();
            $table->string('apetito')->nullable();
            $table->string('miccion')->nullable();
            $table->string('les')->nullable();
            $table->string('vih')->nullable();
            $table->string('otros')->nullable();
            $table->string('hta')->nullable();
            $table->string('anemia')->nullable();
            $table->string('asma')->nullable();
            $table->string('tbc')->nullable();
            $table->string('htaf')->nullable();
            $table->string('anemiaf')->nullable();
            $table->string('asmaf')->nullable();
            $table->string('tbcf')->nullable();
            $table->string('dengue')->nullable();
            $table->string('fiebre')->nullable();
            $table->string('its')->nullable();
            $table->string('stress')->nullable();
            $table->string('trauma')->nullable();
            $table->text('farmacologicos')->nullable();
            $table->text('especificacion')->nullable();
            $table->date('fechae');
            $table->time('hora');
            $table->text('motivo');
            $table->text('tiempo');
            $table->text('sintomas');
            $table->text('relato');
            $table->text('funciones');
            $table->text('estado');
            $table->string('pa', 50);
            $table->string('peso', 50);
            $table->string('talla', 50);
            $table->string('tº', 50);
            $table->string('fc', 50);
            $table->string('fr', 50);
            $table->text('intraoral')->nullable();
            $table->text('extraoral')->nullable();
            $table->unsignedBigInteger('sexos_id');
            $table->unsignedBigInteger('estados_id');
            $table->foreign('sexos_id')->references('id')->on('sexos');
            $table->foreign('estados_id')->references('id')->on('estados');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
