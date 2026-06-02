<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::post('/payments', [
    PaymentController::class,
    'store'
]);

Route::get('/payments/{payment}', [
    PaymentController::class,
    'show'
]);