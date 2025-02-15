<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 *  Route for layouting Landing Page
 */
Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/informasi', function () {
    return view('landing-page.informasi');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});


/**
 *  Route for layouting User Page
 */
Route::get('/user', function () {
    return view('user.dashboard');
});

Route::get('/user/profile', function () {
    return view('user.profile');
});

Route::get('/user/setting', function () {
    return view('user.setting');
});




/**
 *  Route for layouting Admin Page (Dashboard)
 */
Route::get('/admin', function () {
    return view('admin.dashboard');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
