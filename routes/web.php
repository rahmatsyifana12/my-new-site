<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    $boards = app(BoardController::class)->getBoards();
    return view('dashboard', ['boards' => $boards]);
})->name('dashboard');

Route::get('/verified-users', [UserController::class, 'getVerifiedUsers']);

Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::middleware('auth:api')->get('user', [AuthController::class, 'getUser']);
