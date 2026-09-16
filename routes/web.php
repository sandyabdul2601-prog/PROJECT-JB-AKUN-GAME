<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComplaintController;

// Route Transaksi (Order)
Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::post('/order/{id}/complete', [OrderController::class, 'completeOrder'])->name('order.complete');

Route::get('/', function () {
    return view('welcome');
});
// Route Pembayaran & Verifikasi MM
Route::post('/order/{id}/pay', [PaymentController::class, 'uploadPayment'])->name('payment.upload');
Route::post('/order/{id}/confirm-payment', [PaymentController::class, 'confirmPaymentByMM'])->name('payment.confirm');

// Route Komplain & Refund
Route::post('/order/{id}/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::post('/order/{id}/refund', [ComplaintController::class, 'processRefund'])->name('complaint.refund');
