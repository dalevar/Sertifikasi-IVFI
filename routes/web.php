<?php

use App\Http\Controllers\Admin\CertificationController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\UserController;
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
        return view('admin.dashboard', [
            'title' => 'Dashboard'
        ]);
    })->name('dashboard');
    Route::resource('/certificates', CertificationController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/payments', PaymentController::class);
    Route::post('/payments/{id}/validation/', [PaymentController::class, 'validationPayment'])->name('payments.validation');
});

Route::get('/user', function () {
    return view('user');
});

Route::post('logout', [AuthController::class, 'logout'])->name('logout');
