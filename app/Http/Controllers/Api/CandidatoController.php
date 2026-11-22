<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CandidatoController extends Controller
{
    public function index()
    {
        return response()->json(
            Candidato::orderByDesc('id')->get()
        );
    }

    public function store(Request $request)
    {
        $datos = $this->validar($request);

        $candidato = Candidato::create($datos);

        return response()->json([
            'message' => 'Candidato registrado correctamente.',
            'candidato' => $candidato,
        ], 201);
    }

    public function show(Candidato $candidato)
    {
        return response()->json($candidato);
    }

    public function update(Request $request, Candidato $candidato)
    {
        $datos = $this->validar($request, $candidato);

        $candidato->update($datos);

        return response()->json([
            'message' => 'Candidato actualizado correctamente.',
            'candidato' => $candidato->fresh(),
        ]);
    }

    public function destroy(Candidato $candidato)
    {
        try {
            $candidato->delete();

            return response()->json([
                'message' => 'Candidato eliminado correctamente.',
            ]);
        } catch (QueryException $e) {
            $codigoSqlServer = $e->errorInfo[1] ?? null;

            if ($codigoSqlServer == 547) {
                return response()->json([
                    'message' => 'No se puede eliminar el candidato porque tiene postulaciones relacionadas.',
                ], 409);
            }

            throw $e;
        }
    }

    private function validar(
        Request $request,
        ?Candidato $candidato = null
    ): array {
        return $request->validate([
            'nombre_completo' => [
                'required', 'string', 'max:200',
            ],
            'correo_electronico' => [
                'required',
                'email',
                'max:255',
                Rule::unique('candidatos', 'correo_electronico')
                    ->ignore($candidato?->id),
            ],
            'telefono' => [
                'required', 'string', 'max:25',
            ],
            'fecha_nacimiento' => [
                'required',
                'date',
                'before:today',
            ],
            'expectativa_salarial' => [
                'required',
                'numeric',
                'min:0',
                'decimal:0,2',
            ],
        ]);
    }
}
