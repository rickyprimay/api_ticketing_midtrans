<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/event', [LandingController::class, 'index_events'])->name('index_events');
Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
Route::get('/order/{event_id}/{price}', [OrdersController::class, 'order'])->name('order');
Route::post('/create-invoice', [OrdersController::class, 'createInvoice'])->name('create-invoice');

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/tickets/buy/{id}', [TicketController::class, 'buy'])->name('tickets.buy');

Route::group(['middleware' => ['auth:web', 'checkUserRole:0']], function () {

});

Route::group(['middleware' => ['auth:web', 'checkUserRole:1']], function () {

});

Route::group(['middleware' => ['auth:web', 'checkUserRole:2']], function () {

});