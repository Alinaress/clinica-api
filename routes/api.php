<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

// Catálogos
use App\Http\Controllers\Api\CtlGeneroController;
use App\Http\Controllers\Api\CtlGrupoSanguineoController;
use App\Http\Controllers\Api\CtlEspecialidadController;
use App\Http\Controllers\Api\CtlTipoContactoController;
use App\Http\Controllers\Api\CtlTipoTratamientoController;
use App\Http\Controllers\Api\CtlEstadoCitaController;
use App\Http\Controllers\Api\CtlMedicamentoController;

// Mantenimiento
use App\Http\Controllers\Api\MntPacienteController;
use App\Http\Controllers\Api\MntDoctorController;
use App\Http\Controllers\Api\MntDireccionController;
use App\Http\Controllers\Api\MntContactoController;
use App\Http\Controllers\Api\MntExpedienteController;
use App\Http\Controllers\Api\MntCitaController;
use App\Http\Controllers\Api\MntNotificacionController;
use App\Http\Controllers\Api\MntRecetaController;
use App\Http\Controllers\Api\MntDiagnosticoController;

// ===== RUTAS PÚBLICAS =====
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
});

// ===== RUTAS PROTEGIDAS =====
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::prefix('auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me',      [AuthController::class, 'me']);
    });

    // Catálogos — solo admin
    Route::middleware('rol:admin')->prefix('catalogos')->group(function () {
        Route::apiResource('generos',           CtlGeneroController::class);
        Route::apiResource('grupos-sanguineos', CtlGrupoSanguineoController::class);
        Route::apiResource('especialidades',    CtlEspecialidadController::class);
        Route::apiResource('tipo-contactos',    CtlTipoContactoController::class);
        Route::apiResource('tipo-tratamientos', CtlTipoTratamientoController::class);
        Route::apiResource('estado-citas',      CtlEstadoCitaController::class);
        Route::apiResource('medicamentos',      CtlMedicamentoController::class);
    });

    // Pacientes — admin y recepcionista
    Route::middleware('rol:admin,recepcionista')->group(function () {
        Route::apiResource('pacientes',   MntPacienteController::class);
        Route::apiResource('direcciones', MntDireccionController::class);
        Route::apiResource('contactos',   MntContactoController::class);
    });

    // Citas — admin, recepcionista y doctor
    Route::middleware('rol:admin,recepcionista,doctor')->group(function () {
        Route::apiResource('citas',        MntCitaController::class);
        Route::apiResource('notificaciones', MntNotificacionController::class);
        Route::post('notificaciones/leer-todas', [MntNotificacionController::class, 'marcarTodasLeidas']);
    });

    // Expedientes, recetas y diagnósticos — admin y doctor
    Route::middleware('rol:admin,doctor')->group(function () {
        Route::apiResource('doctores',     MntDoctorController::class);
        Route::apiResource('expedientes',  MntExpedienteController::class);
        Route::apiResource('recetas',      MntRecetaController::class);
        Route::apiResource('diagnosticos', MntDiagnosticoController::class);
    });

});