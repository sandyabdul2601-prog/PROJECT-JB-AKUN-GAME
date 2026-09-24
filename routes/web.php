<?php
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComplaintController;

Route::middleware(['auth'])->group(function () {
    // Route milik Orang 3
    Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order/{id}/complete', [OrderController::class, 'complete'])->name('order.complete');

    Route::post('/payment/{id}/upload', [PaymentController::class, 'upload'])->name('payment.upload');
    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

    Route::post('/complaint/{id}', [ComplaintController::class, 'store'])->name('complaint.store');
});