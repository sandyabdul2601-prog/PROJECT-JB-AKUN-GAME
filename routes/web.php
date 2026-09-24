<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ComplaintController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $products = Product::with(['game', 'user'])
        ->where('status', 'available')
        ->latest()
        ->take(8)
        ->get();

    return view('home', compact('products'));

})->name('home');

/*
|--------------------------------------------------------------------------
| Produk
|--------------------------------------------------------------------------
*/

Route::get('/produk', [ProductController::class, 'index'])
    ->name('products.index');

/*
|--------------------------------------------------------------------------
| Authentication (Guest)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');

});

/*
|--------------------------------------------------------------------------
| User Login
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Jual akun
    Route::get('/jual-akun', [SellController::class, 'create'])
        ->name('products.create');

    Route::post('/jual-akun', [SellController::class, 'store'])
        ->name('products.store');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Order (fitur Orang 3)
    Route::post('/order/create', [OrderController::class, 'createOrder'])
        ->name('order.create');

    Route::get('/order/{id}', [OrderController::class, 'show'])
        ->name('order.show');

    Route::post('/order/{id}/complete', [OrderController::class, 'complete'])
        ->name('order.complete');

    // Payment (fitur Orang 3)
    Route::post('/payment/{id}/upload', [PaymentController::class, 'upload'])
        ->name('payment.upload');

    Route::post('/payment/{id}/confirm', [PaymentController::class, 'confirm'])
        ->name('payment.confirm');

    // Complaint (fitur Orang 3)
    Route::post('/complaint/{id}', [ComplaintController::class, 'store'])
        ->name('complaint.store');

});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

});