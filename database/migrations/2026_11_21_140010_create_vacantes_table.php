<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vacantes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo_puesto', 100);
            $table->string('descripcion_puesto', 500);
            $table->decimal('salario_minimo', 12, 2);
            $table->decimal('salario_maximo', 12, 2);
            $table->string('ubicacion', 255);
            $table->foreignId('unidad_id')->constrained('unidades');
            $table->foreignId('modalidad_trabajo_id')->constrained('modalidades_trabajo');
            $table->foreignId('user_crea_id')->constrained('users');
            $table->foreignId('estado_vacante_id')->constrained('estados_vacante');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vacantes');
    }
};
