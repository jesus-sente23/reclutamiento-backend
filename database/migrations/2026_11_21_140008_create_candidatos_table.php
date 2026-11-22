<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_completo', 200);
            $table->string('correo_electronico', 255)->unique();
            $table->string('telefono', 25);
            $table->date('fecha_nacimiento');
            $table->decimal('expectativa_salarial', 12, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidatos');
    }
};
