<?php

namespace Database\Seeders;

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
            DB::table('estados_postulacion')->updateOrInsert(
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
            DB::table('fuentes_reclutamiento')->updateOrInsert(
                ['nombre' => $nombre],
                [
                    'descripcion' => 'Fuente: ' . $nombre,
                    'updated_at' => now(),
                ]
            );
        }
    }
}
