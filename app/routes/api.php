<?php

use App\Http\Controllers\V1\Grade\GradeController;
use App\Http\Controllers\V1\Lecture\LectureController;
use App\Http\Controllers\V1\Plan\PlanController;
use App\Http\Controllers\V1\Student\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('v1')->group(function () {
    Route::apiResource('students', StudentController::class);

    Route::apiResource('grades', GradeController::class);
    Route::get('grades/{grade}/plan/', [GradeController::class, 'plan']);

    Route::controller(PlanController::class)->group(function () {
        Route::patch('/grades/{grade}/plan', 'update');
        Route::post('/plan', 'store');
        Route::delete('/plan', 'destroy');
    });

    Route::apiResource('/lectures', LectureController::class);
});


