<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\AdviserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\BookTransactionController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BookHistoryController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\AppSettingController;

use App\Http\Controllers\Borrower\BorrowerFrontendController;




Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Auth::routes(['verify' => true]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/notifications/get', [NotificationController::class, 'get'])->name('notification.get');
    Route::get('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notification.markAsRead');


    Route::get('/users/search', [UserController::class, 'search']);

    Route::prefix('admin')->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

        Route::get('/notifications', [NotificationController::class, 'index'])->name('notification-index');
        
        Route::get('/borrowers', [BorrowerController::class, 'index'])->name('borrower-index');
        Route::get('/borrowers/create', [BorrowerController::class, 'create'])->name('borrower-create');
        Route::get('/borrowers/{borrower}', [BorrowerController::class,'show'])->name('borrower-show');
        Route::post('/borrowers', [BorrowerController::class, 'store'])->name('borrower-store');
        Route::post('/borrowers/{borrower}', [BorrowerController::class, 'update'])->name('borrower-update');
        Route::delete('/borrowers/{borrower}', [BorrowerController::class, 'destroy'])->name('borrower-delete');

        Route::get('/sections', [SectionController::class, 'index'])->name('section-index');
        Route::post('/sections', [SectionController::class, 'store'])->name('section-store');
        Route::post('/sections/{section}', [SectionController::class, 'update'])->name('section-update');
        Route::delete('/sections/{section}', [SectionController::class, 'destroy'])->name('section-delete');

        Route::get('/advisers', [AdviserController::class, 'index'])->name('adviser-index');
        Route::post('/advisers', [AdviserController::class, 'store'])->name('adviser-store');
        Route::post('/advisers/{adviser}', [AdviserController::class, 'update'])->name('adviser-update');
        Route::delete('/advisers/{adviser}', [AdviserController::class, 'destroy'])->name('adviser-delete');

        Route::get('/departments', [DepartmentController::class, 'index'])->name('department-index');
        Route::post('/departments', [DepartmentController::class, 'store'])->name('department-store');
        Route::post('/departments/{department}', [DepartmentController::class, 'update'])->name('department-update');
        Route::delete('/departments/{department}', [DepartmentController::class, 'destroy'])->name('department-delete');


        Route::get('/books', [BookController::class, 'index'])->name('book-index');
        Route::get('/books/create', [BookController::class, 'create'])->name('book-create');
        Route::get('/books/{book}', [BookController::class, 'show'])->name('book-show');
        Route::post('/books', [BookController::class, 'store'])->name('book-store');
        Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('book-delete');
        Route::post('/books/{book}', [BookController::class, 'update'])->name('book-update');

        Route::get('/book-requests', [BookRequestController::class, 'allBookRequests'])->name('admin.book-requests');
        Route::post('/book-requests/{bookRequest}/approve', [BookRequestController::class, 'approveBookRequest'])->name('admin.book-requests-approve');
        Route::post('/book-requests/{bookRequest}/reject', [BookRequestController::class, 'rejectBookRequest'])->name('admin.book-requests-reject');

        Route::get('/book-transactions', [BookTransactionController::class, 'index'])->name('admin.book-transactions');
        Route::post('/book-transactions/lend/{book}', [BookTransactionController::class, 'lendBook'])->name('admin.book-transactions.lend-book');
        Route::post('/book-transactions/return/{bookTransaction}', [BookTransactionController::class, 'returnBook'])->name('admin.book-transactions.return-book');

        Route::resource('announcements', AnnouncementController::class);

        Route::get('/book-history', [BookHistoryController::class, 'index'])->name('book-history.index');

        Route::get('/db-backup', [BackupController::class, 'index'])->name('backup.index');
        Route::get('/backup', [BackupController::class, 'createBackup'])->name('backup.create');
        Route::get('/settings', [AppSettingController::class, 'index'])->name('setting.index');
        Route::post('/settings', [AppSettingController::class, 'update'])->name('setting.update');
        Route::post('/settings/upload-image', [AppSettingController::class, 'addGalleryImage'])->name('setting.addGalleryImage');
        Route::post('/settings/delete-image/{gallery}', [AppSettingController::class, 'deleteGalleryImage'])->name('setting.deleteGalleryImage');
        
    });


    Route::prefix('borrower')->group(function () {

        Route::get('/home', [BorrowerFrontendController::class, 'home'])->name('borrower.home');
        Route::get('/borrowed-books', [BorrowerFrontendController::class, 'borrowedBooks'])->name('borrower.borrowed-books');

        Route::get('/notifications', [BorrowerFrontendController::class, 'notifications'])->name('borrower.notifications');

        Route::get('/book-requests', [BookRequestController::class, 'index'])->name('borrower.book-requests');
        Route::get('/book-requests/create', [BookRequestController::class, 'create'])->name('borrower.book-requests-create');
        Route::post('/book-requests', [BookRequestController::class, 'store'])->name('borrower.book-requests-store');
        Route::post('/book-requests/{bookRequest}', [BookRequestController::class, 'update'])->name('borrower.book-requests-update');

        Route::get('/user/profile', [BorrowerFrontendController::class, 'profileView'])->name('borrower.profile');
        Route::post('/user/profile', [BorrowerFrontendController::class, 'profileUpdate'])->name('borrower.profile.update');
    });

});





