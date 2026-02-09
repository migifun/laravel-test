<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReceptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ReceptionController::class, 'form'])->name('reception.form');
Route::post('/reception', [ReceptionController::class, 'store'])->name('reception.store');
Route::get('/reception/{reception}/calling', [ReceptionController::class, 'calling'])->name('reception.calling');

Route::get('/reception', [ReceptionController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('reception.index');

Route::delete('/reception/{reception}', [ReceptionController::class, 'destroy'])
    ->middleware(['auth', 'admin'])
    ->name('reception.destroy');

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
