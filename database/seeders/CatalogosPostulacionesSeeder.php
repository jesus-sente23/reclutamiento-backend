<?php

namespace Database\Seeders;

use App\Models\EstadoPostulacion;
use App\Models\FuenteReclutamiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosPostulacionesSeeder extends Seeder
{
    public function run(): void
    {
        $estados = [
            'Recibida',
            'En revisión',
            'Entrevista',
            'Oferta',
            'Rechazada',
            'Contratada',
        ];

        foreach ($estados as $nombre) {
            EstadoPostulacion::updateOrCreate(
                ['nombre' => $nombre],
                [
                    'descripcion' => 'Estado: ' . $nombre,
                    'updated_at' => now(),
                ]
            );
        }

        $fuentes = [
            'LinkedIn',
            'Referido',
            'Portal de empleo',
            'Otro',
        ];

        foreach ($fuentes as $nombre) {
            FuenteReclutamiento::updateOrCreate(
                ['nombre' => $nombre],
                [
                    'descripcion' => 'Fuente: ' . $nombre,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
