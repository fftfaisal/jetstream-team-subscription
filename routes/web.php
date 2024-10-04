<?php

use App\Http\Controllers\BillingController;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/pricing', [BillingController::class, 'index'])->name('pricing');
    Route::post('/subscribe', [BillingController::class, 'subscribe'])->name('subscribe');
    Route::get('/billing', [StripeController::class, 'portal'])->name('billing');
});


Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);
