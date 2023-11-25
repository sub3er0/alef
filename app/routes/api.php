<?php

use App\Http\Controllers\GradeController;
use App\Http\Controllers\LectureController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

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

Route::get('/test', [TestController::class, 'test']);
Route::apiResource('students', StudentController::class);
Route::apiResource('grades', GradeController::class);
Route::get('grades/{grade}/plan/', [GradeController::class, 'plan']);
Route::patch('/grades/{grade}/plan', [PlanController::class, 'update']);

Route::post('/plan', [PlanController::class, 'store']);
Route::delete('/plan', [PlanController::class, 'destroy']);

Route::get('/lectures/{lecture}', [LectureController::class, 'show']);
Route::post('/lectures', [LectureController::class, 'store']);
Route::patch('/lectures/{lecture}', [LectureController::class, 'update']);
Route::delete('/lectures', [LectureController::class, 'destroy']);

Route::resource('lectures', LectureController::class);

