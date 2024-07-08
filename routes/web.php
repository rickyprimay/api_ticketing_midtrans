<?php

use App\Http\Controllers\AbortController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommiteController;
use App\Http\Controllers\TicketUsersController;
use App\Http\Controllers\UserEditorController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SuperAdminController;
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
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot.password');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot.password');
});
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('auth.reset.password');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

Route::get('/test-email', function () {
    return view('emails.otpMail');
});

Route::get('/', [LandingController::class, 'index'])->name('index');
Route::get('/events/load-more', [LandingController::class, 'loadMore'])->name('events.load.more');
Route::post('/notification', [OrdersController::class, 'notificationCallback'])->name('notification');

Route::get('/tickets/buy/{id}', [TicketController::class, 'buy'])->name('tickets.buy');
Route::get('/events/search', [LandingController::class, 'search'])->name('events.search');

Route::group(['middleware' => 'role:0'], function () {
    Route::get('/tickets', [TicketUsersController::class, 'index'])->name('tickets.index');
    Route::get('/edit-profile', [UserEditorController::class, 'index'])->name('edit.index');
    Route::put('/profile/update', [UserEditorController::class, 'update'])->name('profile.update');
    // Route::get('/event/{event_id}', [EventsController::class, 'show'])->name('event_details');
    // Route::get('/order/{event_id}/{price}', [OrdersController::class, 'order'])->name('order');
    Route::get('/event/{event_id}', [EventsController::class, 'show'])->name('event_details');
    Route::get('/order/{event_id}/{ticket_id}', [OrdersController::class, 'order'])->name('order');
    Route::post('/create-invoice', [OrdersController::class, 'createInvoice'])->name('create-invoice');
    Route::get('/transactions', [OrdersController::class, 'index'])->name('history');
});

Route::group(['middleware' => 'role:1'], function () {
    Route::get('/comitee', [CommiteController::class, 'index'])->name('comitee.index');
    Route::post('/redeem-qr', [OrdersController::class, 'redeemQR'])->name('redeem.qr');
});
Route::group(['middleware' => 'role:2'], function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/ticket', [AdminController::class, 'ticket'])->name('admin.ticket');
    Route::post('/admin/ticket/store', [AdminController::class, 'storeTicket'])->name('admin.ticket.store');
    Route::put('/admin/ticket/update/{id}', [AdminController::class, 'updateTicket'])->name('admin.ticket.update');
    Route::delete('/admin/ticket/destroy/{id}', [AdminController::class, 'destroyTicket'])->name('admin.ticket.destroy');
    Route::get('/admin/event', [AdminController::class, 'event'])->name('admin.event');
    Route::get('/admin/event/create', [AdminController::class, 'createEvent'])->name('event.create');
    Route::post('/admin/event/store', [AdminController::class, 'storeEvent'])->name('admin.event.store');
    Route::put('/admin/event/{id}', [AdminController::class, 'update'])->name('admin.event.update');
    Route::delete('/admin/event/{id}', [AdminController::class, 'destroy'])->name('admin.event.destroy');
    Route::get('/admin/buyer', [AdminController::class, 'buyer'])->name('admin.buyer');
    Route::get('/admin/buyer/{event_id}', [AdminController::class, 'buyerDetail'])->name('admin.buyerDetail');
    Route::get('/admin/export', [AdminController::class, 'exportExcel'])->name('admin.export');
    Route::get('/admin/talent', [AdminController::class, 'talent'])->name('admin.talent');
    Route::post('/admin/talent/store', [AdminController::class, 'storeTalent'])->name('admin.talent.store');
    Route::delete('/admin/talent/{id}', [AdminController::class, 'destroyTalent'])->name('admin.talent.destroy');
    Route::put('/admin/talent/update/{id}', [AdminController::class, 'updateTalent'])->name('admin.talent.update');
});

Route::group(['middleware' => 'role:3'], function () {
    Route::get('/superadmin', [SuperAdminController::class, 'index'])->name('superadmin.index');
    Route::get('/superadmin/users', [SuperAdminController::class, 'user'])->name('superadmin.users');
    Route::get('/superadmin/committee', [SuperAdminController::class, 'committee'])->name('superadmin.committee');
    Route::post('/superadmin/committee/store', [SuperAdminController::class, 'storeCommittee'])->name('superadmin.committee.store');
    Route::delete('/superadmin/committee/{id}', [SuperAdminController::class, 'destroyCommittee'])->name('superadmin.committee.destroy');
    Route::get('/superadmin/admin', [SuperAdminController::class, 'admin'])->name('superadmin.admin');
    Route::post('/superadmin/admin/store', [SuperAdminController::class, 'storeAdmin'])->name('superadmin.admin.store');
    Route::get('/superadmin/event', [SuperAdminController::class, 'event'])->name('superadmin.event');
    Route::put('/superadmin/event/verify/{id}', [SuperAdminController::class, 'verifiedEvent'])->name('superadmin.event.verify');
});

Route::fallback([AbortController::class, 'index']);