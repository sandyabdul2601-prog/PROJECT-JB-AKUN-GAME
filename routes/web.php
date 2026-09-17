<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComplaintController;

Route::get('/', function () {
    return view('welcome');
});

// Route Transaksi (Order)
Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
Route::post('/order/{id}/complete', [OrderController::class, 'completeOrder'])->name('order.complete');

// Route Pembayaran & Verifikasi MM
Route::post('/order/{id}/pay', [PaymentController::class, 'uploadPayment'])->name('payment.upload');
Route::post('/order/{id}/confirm-payment', [PaymentController::class, 'confirmPaymentByMM'])->name('payment.confirm');

// Route Komplain & Refund
Route::post('/order/{id}/complaint', [ComplaintController::class, 'store'])->name('complaint.store');
Route::post('/order/{id}/refund', [ComplaintController::class, 'processRefund'])->name('complaint.refund');

// Route Dummy Halaman Login (Persiapan Tim Auth)
Route::get('/login', function () {
    return 'Halaman Login (Belum dibuat oleh tim autentikasi)';
})->name('login');

// Route Halaman Testing Beli
Route::get('/test-buy', function () {
    return '
        <form action="' . route('order.create') . '" method="POST">
            ' . csrf_field() . '
            <input type="hidden" name="seller_id" value="2">
            <input type="hidden" name="listing_id" value="1">
            <input type="hidden" name="price" value="150000">
            <button type="submit">Uji Coba Beli (POST)</button>
        </form>
    ';
});