<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRequestController;

use App\Http\Controllers\Borrower\BorrowerFrontendController;




Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {

    Route::prefix('admin')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
        
        Route::get('/borrowers', [BorrowerController::class, 'index'])->name('borrower-index');
        Route::post('/borrowers', [BorrowerController::class, 'store'])->name('borrower-store');
        Route::post('/borrowers/{borrower}', [BorrowerController::class, 'update'])->name('borrower-update');

        Route::get('/sections', [SectionController::class, 'index'])->name('section-index');
        Route::post('/sections', [SectionController::class, 'store'])->name('section-store');
        Route::post('/sections/{section}', [SectionController::class, 'update'])->name('section-update');

        Route::get('/advisers', [AdviserController::class, 'index'])->name('adviser-index');
        Route::post('/advisers', [AdviserController::class, 'store'])->name('adviser-store');
        Route::post('/advisers/{adviser}', [AdviserController::class, 'update'])->name('adviser-update');


        Route::get('/books', [BookController::class, 'index'])->name('book-index');
        Route::post('/books', [BookController::class, 'store'])->name('book-store');
        Route::post('/books/{book}', [BookController::class, 'update'])->name('book-update');
    });


    Route::prefix('borrower')->group(function () {

        Route::get('/home', [BorrowerFrontendController::class, 'home'])->name('borrower.home');

        Route::get('/book-requests', [BookRequestController::class, 'index'])->name('borrower.book-requests');
        Route::post('/book-requests', [BookRequestController::class, 'store'])->name('borrower.book-requests-store');
        Route::post('/book-requests/{bookRequest}', [BookRequestController::class, 'update'])->name('borrower.book-requests-update');
    });

});





