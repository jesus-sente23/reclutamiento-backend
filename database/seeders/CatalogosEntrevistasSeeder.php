<?php

namespace Database\Seeders;

use App\Models\ResultadoEntrevista;
use App\Models\TipoEntrevista;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CatalogosEntrevistasSeeder extends Seeder
{
    public function run(): void
    {
        $ahora = now();

        $tipos = [
            [
                'nombre' => 'Recursos Humanos 2',
                'descripcion' => 'Entrevista para evaluar perfil y competencias generales.',
            ],
            [
                'nombre' => 'Técnica 2',
                'descripcion' => 'Entrevista para evaluar conocimientos técnicos.',
            ],
        ];

        foreach ($tipos as $tipo) {
            TipoEntrevista::updateOrCreate(
                ['nombre' => $tipo['nombre']],
                [
                    'descripcion' => $tipo['descripcion'],
                    'updated_at' => $ahora,
                ]
            );
        }

        $resultados = [
            [
                'nombre' => 'Pendiente 2',
                'descripcion' => 'Entrevista pendiente de evaluación.',
            ],
            [
                'nombre' => 'Aprobado 2',
                'descripcion' => 'El candidato aprobó la entrevista.',
            ],
            [
                'nombre' => 'No aprobado 2',
                'descripcion' => 'El candidato no aprobó la entrevista.',
            ],
        ];

        foreach ($resultados as $resultado) {
            ResultadoEntrevista::updateOrCreate(
                ['nombre' => $resultado['nombre']],
                [
                    'descripcion' => $resultado['descripcion'],
                    'updated_at' => $ahora,
                ]
            );
        }
    }
}
