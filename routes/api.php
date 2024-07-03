<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventsController;
use App\Http\Controllers\Api\TalentsController;
use App\Http\Controllers\Api\TicketsController;
use App\Http\Controllers\Api\CallbackController;
use App\Http\Controllers\Api\UserEditorController;

Route::middleware(['CorsMiddleware'])->group(function () {
    // Authentication Routes
    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::post('/register', [AuthController::class, 'register'])->name('register');
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });

    Route::prefix('event')->group(function () {
        Route::get('/', [EventsController::class, 'index']);
        Route::get('/{id}', [EventsController::class, 'show']);
    });
    Route::prefix('events')->group(function () {
        Route::get('/', [EventsController::class, 'index']);
        Route::post('/', [EventsController::class, 'store']);
        Route::get('/{id}', [EventsController::class, 'show']);
        Route::put('/{id}', [EventsController::class, 'update']);
        Route::delete('/{id}', [EventsController::class, 'destroy']);
    });

    // Midtrans Callback
    Route::post('/midtrans/notification/handling', [CallbackController::class, 'callback']);
    Route::get('/tickets/{order_id}/redeem', [CallbackController::class, 'redeem']);

    Route::group(['middleware' => ['auth:api', 'checkUserRole:0']], function () {
        Route::prefix('user')->group(function () {
            Route::put('/edit', [UserEditorController::class, 'update']);
        });
        Route::prefix('tickets')->group(function () {
            Route::get('/', [TicketsController::class, 'index']);
            Route::post('/', [TicketsController::class, 'store']);
            Route::get('/{id}', [TicketsController::class, 'show']);
            Route::put('/{id}', [TicketsController::class, 'update']);
            Route::delete('/{id}', [TicketsController::class, 'destroy']);
        });
        
    });

    Route::group(['middleware' => ['auth:api', 'checkUserRole:1']], function () {
        // Event Routes
        

        // Talent Routes
        Route::prefix('talents')->group(function () {
            Route::get('/', [TalentsController::class, 'index']);
            Route::post('/', [TalentsController::class, 'store']);
            Route::get('/{id}', [TalentsController::class, 'show']);
            Route::put('/{id}', [TalentsController::class, 'update']);
            Route::delete('/{id}', [TalentsController::class, 'destroy']);
        });
    });

    Route::group(['middleware' => ['auth:api', 'checkUserRole:2']], function () {
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index']);
            Route::post('/', [UserController::class, 'store']);
            Route::get('/{id}', [UserController::class, 'show']);
            Route::put('/{id}', [UserController::class, 'update']);
            Route::delete('/{id}', [UserController::class, 'destroy']);
        });
    });
});
