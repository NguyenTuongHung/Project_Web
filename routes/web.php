<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\ChatBotController;

// Admin controllers
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|---------------------------------------------------------------------------
| Trang chủ
|---------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|---------------------------------------------------------------------------
| Auth (User)
|---------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|---------------------------------------------------------------------------
| Liên hệ
|---------------------------------------------------------------------------
*/
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');

/*
|---------------------------------------------------------------------------
| Checkout (User)
|---------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function() {
    Route::get('/checkout', [CartController::class, 'showCheckout'])->name('checkout.show');
    Route::post('/checkout', [CartController::class,'checkout'])->name('checkout');
});

/*
|---------------------------------------------------------------------------
| Các route cần đăng nhập (User)
|---------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class,'update'])->name('profile.update');

    // Lịch sử đơn hàng
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

    // Chi tiết đơn hàng
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // CRUD cho user orders (create, store, edit, update, destroy)
    Route::resource('orders', OrderController::class)->except(['index', 'show']);
});

/*
|---------------------------------------------------------------------------
| Auth (Admin)
|---------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Products
        Route::get('/products', [AdminDashboardController::class,'products'])->name('admin.products');
        Route::post('/products', [AdminDashboardController::class,'storeProduct'])->name('admin.products.store');
        Route::put('/products/{id}', [AdminDashboardController::class,'updateProduct'])->name('admin.products.update');
        Route::delete('/products/{id}', [AdminDashboardController::class,'deleteProduct'])->name('admin.products.delete');

        // Orders
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/orders/{id}/status', [AdminOrderController::class,'updateStatus'])->name('admin.orders.updateStatus');

        // Users
        Route::get('/users', [AdminDashboardController::class,'users'])->name('admin.users');
        Route::put('/users/{id}', [AdminDashboardController::class,'updateUser'])->name('admin.users.update');
    });
});

// test chat bot AI
Route::post('/chat', [ChatBotController::class, 'ask'])->name('chat.ask');













