<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Admin
Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'adminAuthentication']);
Route::middleware(['admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});

Route::get('/user', function () {
    return view('user');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
