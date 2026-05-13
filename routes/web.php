<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Customer / Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/menu/{food}', [CustomerController::class, 'show'])->name('customer.show');

// Checkout (Public)
Route::post('/order/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('order.checkout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // 1. Kelola Menu
    Route::resource('food', App\Http\Controllers\Admin\FoodController::class);

    // 2. Kelola Kategori
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);

    // 3. Kelola Transaksi (Pesanan Masuk)
    Route::resource('transaksi', App\Http\Controllers\Admin\OrderController::class);
    Route::put('/transaksi/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('transaksi.updateStatus');

    // 4. Kelola Laporan & Analitik
    Route::get('/laporan', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('laporan.index');

    // 5. Kelola Admin (Hanya Superadmin)
    Route::middleware(['superadmin'])->group(function () {
        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    });
});

require __DIR__ . '/auth.php';