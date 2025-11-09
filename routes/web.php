<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\EntertainmentController;
use App\Http\Controllers\Auth\RegisterUserController;


// Guest (unauthenticated) routes
Route::middleware('guest')->group(function () {
    Route::get('/', fn() => view('welcome'))->name('welcome');
    Route::get('register', [RegisterUserController::class, 'create'])->name('register');
    Route::post('register', [RegisterUserController::class, 'store']);
    Route::get('login', [SessionController::class, 'create'])->name('login');
    Route::post('login', [SessionController::class, 'store']);
});

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::post('logout', [SessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', [EntertainmentController::class, 'index'])->name('dashboard');
    Route::get('entertainments/trash', [EntertainmentController::class, 'trash'])->name('entertainments.trash');
    Route::get('entertainments/export', [EntertainmentController::class, 'export'])->name('entertainments.export');
    Route::resource('entertainments', EntertainmentController::class);

    Route::post('entertainments/{entertainment}/restore', [EntertainmentController::class, 'restore'])
        ->withTrashed()
        ->name('entertainments.restore');

    Route::delete('entertainments/{entertainment}/force-delete', [EntertainmentController::class, 'forceDelete'])
        ->withTrashed()
        ->name('entertainments.forceDelete');
});
