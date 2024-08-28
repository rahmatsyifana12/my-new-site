<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/verified-users', [UserController::class, 'getVerifiedUsers']);
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/login', [LoginController::class, 'login'])->name('login.submit');