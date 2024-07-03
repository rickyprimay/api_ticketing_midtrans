<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/event', [LandingController::class, 'index_events'])->name('index_events');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth:web', 'checkUserRole:0']], function () {

});

Route::group(['middleware' => ['auth:web', 'checkUserRole:1']], function () {

});

Route::group(['middleware' => ['auth:web', 'checkUserRole:2']], function () {

});