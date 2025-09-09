<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;

Route::get('/', [ProductController::class, 'index'])->name('home');

// Auth (giữ file AuthController nếu bạn đã có)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Checkout: lưu đơn hàng
Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');

// Lịch sử đơn hàng (chỉ cho người đăng nhập xem)
Route::get('/orders', [ProductController::class, 'history'])->name('orders.history')->middleware('auth');

Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');







