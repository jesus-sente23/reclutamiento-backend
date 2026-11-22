<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosVacantesSeeder extends Seeder
{
    public function run(): void
    {
        // Unidades o departamentos
        $unidades = [
            [
                'nombre' => 'Recursos Humanos',
                'descripcion' => 'Gestión y selección del personal.',
            ],
            [
                'nombre' => 'Sistemas',
                'descripcion' => 'Desarrollo de software y soporte tecnológico.',
            ],
            [
                'nombre' => 'Administración',
                'descripcion' => 'Gestión de procesos administrativos.',
            ]
        ];

        foreach ($unidades as $unidad) {
            DB::table('unidades')->updateOrInsert(
                ['nombre' => $unidad['nombre']],
                [
                    'descripcion' => $unidad['descripcion'],
                    'updated_at' => now(),
                ]
            );
        }

        // Modalidades de trabajo
        $modalidades = [
            [
                'nombre' => 'Presencial',
                'descripcion' => 'Trabajo realizado en las instalaciones.',
            ],
            [
                'nombre' => 'Remoto',
                'descripcion' => 'Trabajo realizado a distancia.',
            ],
            [
                'nombre' => 'Híbrido',
                'descripcion' => 'Combinación de trabajo presencial y remoto.',
            ],
        ];

        foreach ($modalidades as $modalidad) {
            DB::table('modalidades_trabajo')->updateOrInsert(
                ['nombre' => $modalidad['nombre']],
                [
                    'descripcion' => $modalidad['descripcion'],
                    'updated_at' => now(),
                ]
            );
        }

        // Estados de vacantes
        $estados = [
            [
                'nombre' => 'Abierta',
                'descripcion' => 'La vacante está disponible para postulaciones.',
            ],
            [
                'nombre' => 'Cerrada',
                'descripcion' => 'La vacante ya no recibe postulaciones.',
            ],
        ];

        foreach ($estados as $estado) {
            DB::table('estados_vacante')->updateOrInsert(
                ['nombre' => $estado['nombre']],
                [
                    'descripcion' => $estado['descripcion'],
                    'updated_at' => now(),
                ]
            );
        }
    }
}
