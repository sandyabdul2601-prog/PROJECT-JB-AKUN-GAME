<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComplaintController;

Route::get('/', function () {
    return view('welcome');
});

// ROUTE TRANSAKSI (Dibuat Publik Sementara untuk Testing Tanpa Login)

// 1. Tampilan Halaman/Form Buat Order (Method GET agar bisa dibuka di browser)
Route::get('/order/create', function () {
    return view('order_create');
})->name('order.create.view');

// 2. Eksekusi Buat Order (Method POST saat tombol diklik)
Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');

// 3. Detail Order & Penyelesaian Transaksi
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::post('/order/{id}/complete', [OrderController::class, 'completeOrder'])->name('order.complete');

// Route Pembayaran & Verifikasi MM
Route::post('/order/{id}/pay', [PaymentController::class, 'uploadPayment'])->name('payment.upload');
Route::post('/order/{id}/confirm-payment', [PaymentController::class, 'confirmPaymentByMM'])->name('payment.confirm');

// Route Komplain & Refund
Route::post('/order/{id}/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::post('/order/{id}/refund', [ComplaintController::class, 'processRefund'])->name('complaint.refund');