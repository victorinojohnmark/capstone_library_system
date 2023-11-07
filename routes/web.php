<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->group(function () {
    
    Route::get('/borrowers', [BorrowerController::class, 'index'])->name('borrower-index');

    Route::get('/sections', [SectionController::class, 'index'])->name('section-index');
    Route::post('/sections', [SectionController::class, 'store'])->name('section-store');
    Route::post('/sections/{section}', [SectionController::class, 'update'])->name('section-update');
});
