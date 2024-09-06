<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PatientController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->get('/patients', [PatientController::class, 'getPatients']);
Route::get('/patients/epic-patient/{id}', [PatientController::class, 'getEpicPatient']);
Route::get('/patients/procedures/{id}', [PatientController::class, 'patientProcedures']);
Route::get('/patients/procedure/{id}', [PatientController::class, 'getProcedure']);

