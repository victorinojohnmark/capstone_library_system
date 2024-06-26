<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\GradeController;

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

Route::get('/sections', [SectionController::class, 'fetchSection']);
Route::get('/advisers', [AdviserController::class, 'fetchAdviser']);
Route::get('/grades', [GradeController::class, 'fetchGrade']);
