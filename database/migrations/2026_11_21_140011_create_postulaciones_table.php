<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_postulacion');
            $table->foreignId('fuente_reclutamiento_id')->constrained('fuentes_reclutamiento');
            $table->foreignId('user_crea_id')->constrained('users');
            $table->foreignId('candidato_id')->constrained('candidatos');
            $table->foreignId('vacante_id')->constrained('vacantes');
            $table->foreignId('estado_postulacion_id')->constrained('estados_postulacion');
            $table->unique(['candidato_id', 'vacante_id']);
            $table->index(['vacante_id', 'estado_postulacion_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postulaciones');
    }
};
