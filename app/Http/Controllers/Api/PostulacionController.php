<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use App\Models\EstadoPostulacion;
use App\Models\FuenteReclutamiento;
use App\Models\Postulacion;
use App\Models\Vacante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PostulacionController extends Controller
{
    public function index(Request $request)
    {
        $filtros = $request->validate([
            'vacante_id' => 'nullable|integer|exists:vacantes,id',
            'estado_postulacion_id' =>
                'nullable|integer|exists:estados_postulacion,id',
        ]);

        $postulaciones = Postulacion::with([
            'candidato',
            'vacante',
            'estadoPostulacion',
            'fuenteReclutamiento',
        ])
            ->when(
                $filtros['vacante_id'] ?? null,
                fn ($query, $id) =>
                $query->where('vacante_id', $id)
            )
            ->when(
                $filtros['estado_postulacion_id'] ?? null,
                fn ($query, $id) =>
                $query->where('estado_postulacion_id', $id)
            )
            ->latest('id')
            ->get();

        return response()->json($postulaciones);
    }

    public function opciones()
    {
        return response()->json([
            'candidatos' => Candidato::orderBy('nombre_completo')->get(),

            'vacantes' => Vacante::with('estadoVacante')
                ->orderBy('titulo_puesto')
                ->get(),

            'estados' => EstadoPostulacion::orderBy('id')->get(),

            'fuentes' => FuenteReclutamiento::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'candidato_id' => [
                'required',
                'integer',
                Rule::exists('candidatos', 'id'),
            ],
            'vacante_id' => [
                'required',
                'integer',
                Rule::exists('vacantes', 'id'),
            ],
            'estado_postulacion_id' => [
                'required',
                'integer',
                Rule::exists('estados_postulacion', 'id'),
            ],
            'fuente_reclutamiento_id' => [
                'required',
                'integer',
                Rule::exists('fuentes_reclutamiento', 'id'),
            ],
        ]);

        $vacante = Vacante::with('estadoVacante')
            ->findOrFail($datos['vacante_id']);

        if (
            mb_strtolower($vacante->estadoVacante?->nombre ?? '')
            !== 'abierta'
        ) {
            throw ValidationException::withMessages([
                'vacante_id' => [
                    'Solo se permiten postulaciones a vacantes abiertas.',
                ],
            ]);
        }

        $existe = Postulacion::where(
            'candidato_id',
            $datos['candidato_id']
        )
            ->where('vacante_id', $datos['vacante_id'])
            ->exists();

        if ($existe) {
            throw ValidationException::withMessages([
                'candidato_id' => [
                    'Este candidato ya está postulado a esta vacante.',
                ],
            ]);
        }

        $datos['user_crea_id'] = $request->user()->id;
        $datos['fecha_postulacion'] = now()->toDateString();

        $postulacion = Postulacion::create($datos);

        return response()->json([
            'message' => 'Postulación registrada correctamente.',
            'postulacion' => $postulacion->load([
                'candidato',
                'vacante',
                'estadoPostulacion',
                'fuenteReclutamiento',
            ]),
        ], 201);
    }

    public function actualizarEstado(
        Request $request,
        Postulacion $postulacion
    ) {
        $datos = $request->validate([
            'estado_postulacion_id' => [
                'required',
                'integer',
                Rule::exists('estados_postulacion', 'id'),
            ],
        ]);

        $postulacion->update($datos);

        return response()->json([
            'message' => 'Estado actualizado correctamente.',
            'postulacion' => $postulacion->load(
                'estadoPostulacion'
            ),
        ]);
    }
}
