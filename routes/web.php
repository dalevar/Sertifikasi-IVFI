<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\MemberController;
use App\Http\Controllers\User\CertificateRegistrationController;
use App\Http\Controllers\User\DownloadCertificateController;
use App\Http\Controllers\User\PaymentHistoryController;
use App\Http\Controllers\PDFController;

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
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

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
Route::get('/certifications/{registration}', [CertificateRegistrationController::class, 'show'])->name('registration.show');

/**
 * Route for Download Certificate User
 *
 * download-certificate.index -> Menampilkan data sertifikat yang telah didaftarkan oleh user
 * download-certificate.show -> Menampilkan detail sertifikat yang telah didaftarkan oleh user
 * download-certificate.download -> Mengunduh sertifikat member yang telah didaftarkan oleh user
 *
 */
Route::get('/download-certificate', [DownloadCertificateController::class, 'index'])->name('download-certificate.index');
Route::get('/download-certificate/{registration}', [DownloadCertificateController::class, 'show'])->name('download-certificate.show');

Route::get('/download-certificate/download/{id}', [PDFController::class, 'download'])->name('download-certificate.download');



/**
 * Route for Payment Histories
 * Payment-histories.index -> Menampilkan data pembayaran yang telah dilakukan oleh user
 * Payment-histories.show -> Menampilkan detail pembayaran
 * Payment-histories.invoice -> Menampilkan invoice pembayaran
 * Payment-histories.update -> Mengupdate status pembayaran
 */
Route::get('/payment-histories', [PaymentHistoryController::class, 'index'])->name('payment-histories.index');
Route::get('payment-histories/{paymentHistory}/detail', [PaymentHistoryController::class, 'show'])->name('payment-histories.show');
Route::get('/payment/{paymentHistory}/invoice', [PaymentHistoryController::class, 'invoice'])->name('payment-histories.invoice');
Route::patch('/payment/{paymentHistory}/update', [PaymentHistoryController::class, 'update'])->name('payment.upload-proof');
