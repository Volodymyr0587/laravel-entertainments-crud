<?php

use App\Http\Controllers\EntertainmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntertainmentController::class, 'index']);
Route::resource('entertainments', EntertainmentController::class);
