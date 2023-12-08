<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ResetPassswordLinkController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(RegisteredUserController::class)
        ->prefix('register')
        ->group(function () {
            Route::get('/', 'create')->name('register');
            Route::post('/', 'store');
        });
    Route::controller(AuthenticatedSessionController::class)
        ->prefix('login')
        ->group(function () {
            Route::get('/', 'create')->name('login');
            Route::post('/', 'store');
        });
    Route::prefix('/reset-password')->group(function () {
        Route::view('/', 'auth.reset-password')->name('reset-password');
        Route::view('/{id}', 'auth.confirm-reset-password')->name('reset-password.confirm');
        Route::controller(ResetPassswordLinkController::class)->group(function () {
            Route::post('/', 'sendResetLink')->name('reset-password.send_mail');
            Route::post('/{id}', 'resetPassword')->name('reset-password.handle');
        });
    });
    //
//    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
//    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
//    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
//    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    //    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');
//    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');
//    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
//    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
//    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
