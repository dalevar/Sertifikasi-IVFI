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
Route::get('/certifications/{registration}', [CertificateRegistrationController::class, 'show'])->name('registration.show');

/**
 * Route for Download Certificate User
 *
 * DownloadCertificate.index -> Menampilkan data sertifikat yang telah didaftarkan oleh user
 * DownloadCertificate.show -> Menampilkan detail sertifikat yang telah didaftarkan oleh user
 * DownloadCertificate.download -> Mengunduh sertifikat member yang telah didaftarkan oleh user
 * DownloadCertificate.downloadAll -> Mengunduh sertifikat semua member yang telah didaftarkan oleh user
 *
 */
Route::get('/download-certificate', [App\Http\Controllers\User\DownloadCertificateController::class, 'index'])->name('download-certificate.index');
Route::get('/download-certificate/{registration}', [App\Http\Controllers\User\DownloadCertificateController::class, 'show'])->name('download-certificate.show');

Route::get('/download-certificate/download', [App\Http\Controllers\User\DownloadCertificateController::class, 'download'])->name('download-certificate.download');

Route::get('/download-certificate/{registration}/download', [App\Http\Controllers\User\DownloadCertificateController::class, 'downloadAll'])->name('download-certificate.downloadAll');


/**
 * Route for Payment Histories
 * Payment-histories.index -> Menampilkan data pembayaran yang telah dilakukan oleh user
 * Payment-histories.show -> Menampilkan detail pembayaran
 * Payment-histories.invoice -> Menampilkan invoice pembayaran
 * Payment-histories.update -> Mengupdate status pembayaran
 */
Route::get('/payment-histories', [App\Http\Controllers\User\PaymentHistoryController::class, 'index'])->name('payment-histories.index');
Route::get('payment-histories/{paymentHistory}/detail', [App\Http\Controllers\User\PaymentHistoryController::class, 'show'])->name('payment-histories.show');
Route::get('/payment/{paymentHistory}/invoice', [App\Http\Controllers\User\PaymentHistoryController::class, 'invoice'])->name('payment-histories.invoice');
Route::patch('/payment/{paymentHistory}/update', [App\Http\Controllers\User\PaymentHistoryController::class, 'update'])->name('payment.upload-proof');
