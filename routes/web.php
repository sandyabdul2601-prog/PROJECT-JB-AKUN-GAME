<?php

use Illuminate\Support\Facades\Route;

use App\Models\Product;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\AuthController;


// =========================
// HOME
// =========================

<<<<<<< HEAD
Route::get('/', function () {

    $products = Product::with(['game', 'user'])
        ->where('status', 'available')
        ->latest()
        ->take(8)
        ->get();

    return view('home', compact('products'));

})->name('home');

// =========================
// PRODUK
// =========================

Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');


// =========================
// REGISTER
// =========================

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');


    // =====================
    // LOGIN
    // =====================

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

});


// =========================
// USER LOGIN
// =========================

Route::middleware('auth')->group(function () {

    // Jual akun
    Route::get('/jual-akun', [SellController::class, 'create'])
        ->name('products.create');

    Route::post('/jual-akun', [SellController::class, 'store'])
        ->name('products.store');


    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});
=======
Route::middleware(['auth'])->group(function () {
    // Route milik Orang 3
    Route::post('/order/create', [OrderController::class, 'createOrder'])->name('order.create');
    Route::get('/order/{id}', [OrderController::class, 'show'])->name('order.show');
    Route::post('/order/{id}/complete', [OrderController::class, 'complete'])->name('order.complete');

    Route::post('/payment/{id}/upload', [PaymentController::class, 'upload'])->name('payment.upload');
    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])->name('payment.confirm');

    Route::post('/complaint/{id}', [ComplaintController::class, 'store'])->name('complaint.store');
});

>>>>>>> 5afd60d (feat: perbaiki controller, routing, dan UI detail transaksi escrow)
