<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BoardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/dashboard', function () {
    $boards = app(BoardController::class)->getBoards();
    return view('dashboard', ['boards' => $boards]);
})->name('dashboard');

Route::get('/verified-users', [UserController::class, 'getVerifiedUsers']);
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
