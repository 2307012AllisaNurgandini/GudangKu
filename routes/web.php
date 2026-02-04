<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('items.index');
});

// Login & Logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Semua route items harus login
Route::middleware('auth')->group(function () {
Route::resource('items', ItemController::class);
Route::get('/print', [ItemController::class, 'print'])->name('items.print');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

