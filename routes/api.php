<?php

use App\Http\Controllers\Api\CandidatoController;
use App\Http\Controllers\Api\EntrevistaController;
use App\Http\Controllers\Api\PostulacionController;
use App\Http\Controllers\Api\VacanteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/conexion', function () {
    return response()->json([
        'success' => true,
        'message' => 'Conexión exitosa con Laravel',
    ]);
});

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

Route::middleware('auth:sanctum')->group(function () {
    //autenticacion
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    //vacantes
    Route::get('/vacantes/opciones', [VacanteController::class, 'opciones']);
    Route::apiResource('vacantes', VacanteController::class);

    //candidatos
    Route::apiResource('candidatos', CandidatoController::class);

    //postulaciones
    Route::get('/postulaciones/opciones', [PostulacionController::class, 'opciones']);
    Route::get('/postulaciones', [PostulacionController::class, 'index']);
    Route::post('/postulaciones', [PostulacionController::class, 'store']);
    Route::patch('/postulaciones/{postulacion}/estado', [PostulacionController::class, 'actualizarEstado']);

    //entrevistas
    Route::get('/entrevistas/opciones', [EntrevistaController::class, 'opciones']);
    Route::apiResource('entrevistas', EntrevistaController::class);
});
