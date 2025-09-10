<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\EcommerceController;

// Route utama
Route::get('/', [EcommerceController::class, 'index'])->name('home');

// Routing dasar
Route::get('/sample', function () {
    return 'Hallo WhyRixx';
});
Route::get('/sample2', function () {
    return view('sample2');
});

// Routing controller & view dasar
Route::get('/sample3', [LatihanController::class, 'index']);

// Auth routes
Auth::routes();

// Siswa routes
Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [SiswaController::class, 'store'])->name('siswa.store');

// Testing & latihan
Route::get('/testing', function () {
    return view('layouts.admin');
});
Route::get('/latihan-js', function () {
    return view('latihan-js');
});

// Admin routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth', IsAdminMiddleware::class]
], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('product', ProductController::class);
    Route::resource('category', CategoryController::class);
});

// User routes (masih kosong)
Route::group([
    'prefix' => 'user',
    'as' => 'user.',
    'middleware' => ['auth']
], function () {
    // Tambahkan route user di sini jika diperlukan
});

// Ecommerce (order) routes
Route::group(['middleware' => ['auth']], function () {
    Route::post('/order', [EcommerceController::class, 'createOrder'])->name('Order.create');
    Route::post('/checkout', [EcommerceController::class, 'checkOut'])->name('checkOut');
    Route::get('/my-orders', [EcommerceController::class, 'myOrders'])->name('orders.my');
    Route::get('/my-orders/{id}', [EcommerceController::class, 'orderDetail'])->name('orders.detail');
    Route::post('order/update-quantity', [EcommerceController::class, 'updateQuantity'])->name('updateQuantity');
    Route::post('order/remove-item', [EcommerceController::class, 'removeItem'])->name('removeItem');
});

