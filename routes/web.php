<?php

use Illuminate\Support\Facades\Route;

use App\Models\Product;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\AuthController;


// =========================
// HOME
// =========================

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