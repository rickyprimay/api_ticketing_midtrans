<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommiteController;
use App\Http\Controllers\TicketUsersController;
use App\Http\Controllers\UserEditorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/verify', [AuthController::class, 'showVerifyForm'])->name('verify.form');
    Route::post('/verify', [AuthController::class, 'verifyOTP'])->name('verify');
    Route::post('/resend-otp', [AuthController::class, 'resendOTP'])->name('resend.otp');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/test-email', function () {
    return view('emails.otpMail');
});

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/event', [EventsController::class, 'index'])->name('event');
Route::post('/notification', [OrdersController::class, 'notificationCallback'])->name('notification');

Route::get('/events', [EventsController::class, 'index'])->name('events.index');
Route::get('/tickets/buy/{id}', [TicketController::class, 'buy'])->name('tickets.buy');
Route::get('/events/search', [LandingController::class, 'search'])->name('events.search');

Route::group(['middleware' => 'role:0'], function () {
    Route::get('/tickets', [TicketUsersController::class, 'index'])->name('tickets.index');
    Route::get('/edit-profile', [UserEditorController::class, 'index'])->name('edit.index');
    Route::put('/profile/update', [UserEditorController::class, 'update'])->name('profile.update');
    Route::get('/event/{event_id}', [EventsController::class, 'show'])->name('event_details');
    Route::get('/order/{event_id}/{price}', [OrdersController::class, 'order'])->name('order');
    Route::post('/create-invoice', [OrdersController::class, 'createInvoice'])->name('create-invoice');
    Route::get('/transactions', [OrdersController::class, 'index'])->name('history');
});

Route::group(['middleware' => 'role:1'], function () {
    Route::get('/comitee', [CommiteController::class, 'index'])->name('comitee.index');
});
Route::group(['middleware' => 'role:2'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/ticket', [AdminController::class, 'ticket'])->name('admin.ticket');
    Route::get('/admin/event', [AdminController::class, 'event'])->name('admin.event');
    Route::get('/admin/event/create', [AdminController::class, 'createEvent'])->name('event.create');
    Route::post('/admin/event/store', [AdminController::class, 'storeEvent'])->name('admin.event.store');
    Route::put('/admin/event/{id}', [AdminController::class, 'update'])->name('admin.event.update');
    Route::delete('/admin/event/{id}', [AdminController::class, 'destroy'])->name('admin.event.destroy');
});

Route::group(['middleware' => 'role:3'], function () {
    
});

