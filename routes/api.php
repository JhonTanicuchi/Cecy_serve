<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CatalogsController;
use App\Http\Controllers\CareersController;
use App\Http\Controllers\CoursesController;

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


Route::post('/auth/login', [AuthController::class, 'login']);
/* Route::group(
    ['middleware' => ['authentication']],
    function () { */

/*  Route::group(['middleware' => ['role:Admin']], function () { */
Route::prefix('enrollments')->group(function () {
    //ruta para obtener todas las matriculas
    Route::get('/', [EnrollmentController::class, 'getEnrollments']);
    //ruta para obtener una lista de matriculas por parametros
    Route::post('/filter', [EnrollmentController::class, 'getEnrollmentsByParams']);
    //ruta para obtener una lista de matriculas por el tipo de matricula
    Route::get('/type/{type}', [EnrollmentController::class, 'getEnrollmentsByType']);
    //ruta para obtener una lista de matriculas por termino de búsqueda
    Route::get('/search/term/{term?}', [EnrollmentController::class, 'getEnrollmentsBySearch']);
    //
});

Route::get('/catalogs/{type}', [CatalogsController::class, 'getCatalogsByType']);
Route::get('/careers', [CareersController::class, 'getCareers']);
Route::get('/courses', [CoursesController::class, 'getCourses']);
     /*    }); */
/*     }
);
 */
