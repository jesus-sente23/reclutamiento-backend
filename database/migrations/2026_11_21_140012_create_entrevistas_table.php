<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrevistas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->foreignId('postulacion_id')->constrained('postulaciones');
            $table->foreignId('user_crea_id')->constrained('users');
            $table->foreignId('entrevistador_id')->constrained('users');
            $table->foreignId('tipo_entrevista_id')->constrained('tipos_entrevista');
            $table->foreignId('resultado_entrevista_id')->constrained('resultados_entrevista');
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrevistas');
    }
};
