<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\KavlingController;
use Illuminate\Support\Facades\Route;

Route::resource('/', BerandaController::class);
Route::resource('/kavling', KavlingController::class);
Route::get('/informasi', [KavlingController::class, 'informasi']);
Route::get('/tentang', [KavlingController::class, 'tentang']);
Route::post('kavling/payment/{id}', [KavlingController::class, 'payment'])->name('kavling.payment');
Route::get('midtrans/callback', [KavlingController::class, 'callback']);
