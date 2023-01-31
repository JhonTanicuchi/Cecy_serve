<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EnrollmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//ruta para obtener todas las matriculas
Route::get('/enrollments', [EnrollmentController::class, 'index']);
//ruta para obtener una lista de matriculas por cuatro parámetros opcionales:carrera,curso,paralelo,jornada,periodo
Route::get('/enrollments/filter/{career?}/{course?}/{parallel?}/{working_day?}/{period?}', [EnrollmentController::class, 'getEnrollments']);
//ruta para obtener una lista de matriculas por el tipo de matricula
Route::get('/enrollments/type/{type}', [EnrollmentController::class, 'getEnrollmentsByType']);
//ruta para obtener una lista de matriculas por termino de búsqueda
Route::get('/enrollments/search/term/{term?}', [EnrollmentController::class, 'getEnrollmentsBySearch']);


