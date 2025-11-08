<?php

use App\Http\Controllers\EntertainmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntertainmentController::class, 'index']);

Route::get('entertainments/trash', [EntertainmentController::class, 'trash'])->name('entertainments.trash');
Route::get('/entertainments/export', [EntertainmentController::class, 'export'])->name('entertainments.export');

Route::resource('entertainments', EntertainmentController::class);

Route::post('entertainments/{entertainment}/restore', [EntertainmentController::class, 'restore'])->withTrashed()->name('entertainments.restore');
Route::delete('entertainments/{entertainment}/force-delete', [EntertainmentController::class, 'forceDelete'])->withTrashed()->name('entertainments.forceDelete');
