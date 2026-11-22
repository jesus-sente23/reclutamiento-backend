<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vacante;
use App\Models\Unidad;
use App\Models\ModalidadTrabajo;
use App\Models\EstadoVacante;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VacanteController extends Controller
{
    public function index()
    {
        $vacantes = Vacante::with([
            'unidad',
            'modalidadTrabajo',
            'estadoVacante',
        ])
            ->latest('id')
            ->get();

        return response()->json($vacantes);
    }

    public function opciones()
    {
        return response()->json([
            'unidades' => Unidad::orderBy('id')->get(),
            'modalidades' => ModalidadTrabajo::orderBy('id')->get(),
            'estados' => EstadoVacante::orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $datos = $this->validar($request);

        // El usuario creador siempre se obtiene de la sesión.
        $datos['user_crea_id'] = $request->user()->id;

        $vacante = Vacante::create($datos);

        return response()->json([
            'message' => 'Vacante registrada correctamente.',
            'vacante' => $vacante->load([
                'unidad',
                'modalidadTrabajo',
                'estadoVacante',
            ]),
        ], 201);
    }

    public function show(Vacante $vacante)
    {
        return response()->json(
            $vacante->load([
                'unidad',
                'modalidadTrabajo',
                'estadoVacante',
            ])
        );
    }

    public function update(Request $request, Vacante $vacante)
    {
        $datos = $this->validar($request);

        // No modificar el usuario que creó la vacante.
        $vacante->update($datos);

        return response()->json([
            'message' => 'Vacante actualizada correctamente.',
            'vacante' => $vacante->fresh()->load([
                'unidad',
                'modalidadTrabajo',
                'estadoVacante',
            ]),
        ]);
    }

    public function destroy(Vacante $vacante)
    {
        $vacante->delete();

        return response()->json([
            'message' => 'Vacante eliminada correctamente.',
        ]);
    }

    private function validar(Request $request): array
    {
        return $request->validate([
            'titulo_puesto' => 'required|string|max:100',
            'descripcion_puesto' => 'required|string|max:500',
            'salario_minimo' => 'required|numeric|min:0',
            'salario_maximo' => 'required|numeric|gte:salario_minimo',
            'ubicacion' => 'required|string|max:255',
            'unidad_id' => [
                'required',
                'integer',
                Rule::exists('unidades', 'id'),
            ],
            'modalidad_trabajo_id' => [
                'required',
                'integer',
                Rule::exists('modalidades_trabajo', 'id'),
            ],
            'estado_vacante_id' => [
                'required',
                'integer',
                Rule::exists('estados_vacante', 'id'),
            ],
        ]);
    }
}
