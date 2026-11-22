<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosEntrevistasSeeder extends Seeder
{
    public function run(): void
    {
        $ahora = now();

        $tipos = [
            [
                'nombre' => 'Recursos Humanos',
                'descripcion' => 'Entrevista para evaluar perfil y competencias generales.',
            ],
            [
                'nombre' => 'Técnica',
                'descripcion' => 'Entrevista para evaluar conocimientos técnicos.',
            ],
        ];

        foreach ($tipos as $tipo) {
            DB::table('tipos_entrevista')->updateOrInsert(
                ['nombre' => $tipo['nombre']],
                [
                    'descripcion' => $tipo['descripcion'],
                    'updated_at' => $ahora,
                ]
            );
        }

        $resultados = [
            [
                'nombre' => 'Pendiente',
                'descripcion' => 'Entrevista pendiente de evaluación.',
            ],
            [
                'nombre' => 'Aprobado',
                'descripcion' => 'El candidato aprobó la entrevista.',
            ],
            [
                'nombre' => 'No aprobado',
                'descripcion' => 'El candidato no aprobó la entrevista.',
            ],
        ];

        foreach ($resultados as $resultado) {
            DB::table('resultados_entrevista')->updateOrInsert(
                ['nombre' => $resultado['nombre']],
                [
                    'descripcion' => $resultado['descripcion'],
                    'updated_at' => $ahora,
                ]
            );
        }
    }
}
