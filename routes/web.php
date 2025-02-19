<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\User\CertificateRegistrationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

/**
 *  Route for layouting Admin Page (Dashboard)
 */
Route::get('/admin', function () {
    return view('admin.dashboard');
});

/**
 * Authentification Route
 */
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Route for User Profile
 */
Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [App\Http\Controllers\User\ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/update', [App\Http\Controllers\User\ProfileController::class, 'update'])->name('profile.update');

/**
 * Route for Member
 */
Route::resource('members', MemberController::class);


/**
 * Route for Certificate Registration User
 */
Route::get('/certifications', [CertificateRegistrationController::class, 'index'])->name('certifications.index');
Route::get('/certifications/{certification}/create', [CertificateRegistrationController::class, 'create'])->name('certifications.create');
Route::post('/certifications/store', [CertificateRegistrationController::class, 'store'])->name('certifications.store');
Route::get('/certifications/{certification}', [CertificateRegistrationController::class, 'show'])->name('certifications.show');

/**
 * Route for Payment Histories
 * Payment-histories.index -> Menampilkan data pembayaran yang telah dilakukan oleh user
 * Payment-histories.invoice -> Menampilkan invoice pembayaran
 * Payment-histories.update -> Mengupdate status pembayaran
 */

Route::get('/payment-histories', [App\Http\Controllers\User\PaymentHistoryController::class, 'index'])->name('payment-histories.index');
Route::get('/payment/{paymentHistory}/invoice', [App\Http\Controllers\User\PaymentHistoryController::class, 'invoice'])->name('payment-histories.invoice');
Route::patch('/payment/{paymentHistory}/update', [App\Http\Controllers\User\PaymentHistoryController::class, 'update'])->name('payment.upload-proof');







// Middleware untuk role
// Route::group(['middleware' => ['auth', 'role:admin']], function () {
//     Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
//     Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('home');
// });

// Route::group(['middleware' => ['auth', 'role:user']], function () {
//     Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index']);
//     Route::get('/home', [App\Http\Controllers\UserController::class, 'index'])->name('home');
// });
