<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Entrevista;
use App\Models\Postulacion;
use App\Models\ResultadoEntrevista;
use App\Models\TipoEntrevista;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EntrevistaController extends Controller
{
    private array $relaciones = [
        'postulacion.candidato',
        'postulacion.vacante',
        'entrevistador',
        'tipoEntrevista',
        'resultadoEntrevista',
    ];

    public function index()
    {
        return response()->json(
            Entrevista::with($this->relaciones)
                ->orderByDesc('fecha_hora')
                ->get()
        );
    }

    public function opciones()
    {
        return response()->json([
            'postulaciones' => Postulacion::with([
                'candidato',
                'vacante',
            ])->orderByDesc('id')->get(),

            'entrevistadores' => User::query()
                ->select('id', 'name', 'email')
                ->orderBy('name')
                ->get(),

            'tipos' => TipoEntrevista::orderBy('id')->get(),

            'resultados' => ResultadoEntrevista::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $this->validar($request);

        $datos['user_crea_id'] = $request->user()->id;

        $entrevista = Entrevista::create($datos);

        return response()->json([
            'message' => 'Entrevista registrada correctamente.',
            'entrevista' => $entrevista->load($this->relaciones),
        ], 201);
    }

    public function show(Entrevista $entrevista)
    {
        return response()->json(
            $entrevista->load($this->relaciones)
        );
    }

    public function update(
        Request $request,
        Entrevista $entrevista
    ) {
        $datos = $this->validar($request);

        // Se conserva el usuario que creó la entrevista.
        $entrevista->update($datos);

        return response()->json([
            'message' => 'Entrevista actualizada correctamente.',
            'entrevista' => $entrevista->fresh()
                ->load($this->relaciones),
        ]);
    }

    public function destroy(Entrevista $entrevista)
    {
        $entrevista->delete();

        return response()->json([
            'message' => 'Entrevista eliminada correctamente.',
        ]);
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'fecha_hora' => [
                'required',
                'date',
            ],
            'postulacion_id' => [
                'required',
                'integer',
                Rule::exists('postulaciones', 'id'),
            ],
            'entrevistador_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id'),
            ],
            'tipo_entrevista_id' => [
                'required',
                'integer',
                Rule::exists('tipos_entrevista', 'id'),
            ],
            'resultado_entrevista_id' => [
                'required',
                'integer',
                Rule::exists('resultados_entrevista', 'id'),
            ],
            'observaciones' => [
                'nullable',
                'string',
            ],
        ]);
    }
}
