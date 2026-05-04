<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PaymentController;

/**
 * Payment Gateway Routes
 */

Route::middleware('auth')->group(function () {
    // GCash Payment Routes
    Route::prefix('payment/gcash')->name('payment.gcash.')->group(function () {
        Route::get('show', [PaymentController::class, 'showGCash'])->name('show');
        Route::post('verify', [PaymentController::class, 'verifyGCash'])->name('verify');
    });

    // GoTyme Bank Payment Routes
    Route::prefix('payment/gotyme')->name('payment.gotyme.')->group(function () {
        Route::get('show', [PaymentController::class, 'showGoTyme'])->name('show');
        Route::post('verify', [PaymentController::class, 'verifyGoTyme'])->name('verify');
    });

    // BDO Pay Routes
    Route::prefix('payment/bdopay')->name('payment.bdopay.')->group(function () {
        Route::get('show', [PaymentController::class, 'showBDOPay'])->name('show');
        Route::post('verify', [PaymentController::class, 'verifyBDOPay'])->name('verify');
    });

    // Atome Payment Routes
    Route::prefix('payment/atome')->name('payment.atome.')->group(function () {
        Route::get('show', [PaymentController::class, 'showAtome'])->name('show');
        Route::post('verify', [PaymentController::class, 'verifyAtome'])->name('verify');
    });
});

// Webhook routes (no auth needed)
Route::prefix('payment')->name('payment.')->group(function () {
    Route::get('gcash/callback', [PaymentController::class, 'gcashCallback'])->name('gcash.callback');
    Route::get('gotyme/callback', [PaymentController::class, 'gotymeCallback'])->name('gotyme.callback');
    Route::get('bdopay/callback', [PaymentController::class, 'bdopayCallback'])->name('bdopay.callback');
    Route::get('atome/callback', [PaymentController::class, 'atomeCallback'])->name('atome.callback');
});
