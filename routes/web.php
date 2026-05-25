<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Customer / Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [CustomerController::class, 'welcomeRedirect'])->name('customer.welcome');
Route::get('/menu', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/menu/{food}', [CustomerController::class, 'show'])->name('customer.show');
Route::get('/debug-db', function() {
    try {
        $defaultConnection = config('database.default');
        $driver = config("database.connections.{$defaultConnection}.driver");
        $host = config("database.connections.{$defaultConnection}.host");
        $database = config("database.connections.{$defaultConnection}.database");
        
        // Test connection
        $pdo = \Illuminate\Support\Facades\DB::connection()->getPdo();
        $isConnected = $pdo ? true : false;
        
        // Count users
        $userCount = 0;
        $users = [];
        if (\Illuminate\Support\Facades\Schema::hasTable('users')) {
            $userCount = \App\Models\User::count();
            $users = \App\Models\User::select('name', 'email', 'role')->get()->toArray();
        }
        
        return [
            'default_connection' => $defaultConnection,
            'driver' => $driver,
            'host' => $host,
            'database' => $database,
            'is_connected' => $isConnected,
            'user_count' => $userCount,
            'users' => $users
        ];
    } catch (\Exception $e) {
        return [
            'error' => $e->getMessage(),
            'default_connection' => config('database.default')
        ];
    }
});

Route::get('/debug-env', function() {
    $envKeys = array_keys($_ENV);
    $serverKeys = array_keys($_SERVER);
    
    // Check specific keys of interest
    $mysqlHostPresent = isset($_ENV['MYSQLHOST']) || isset($_SERVER['MYSQLHOST']);
    $dbConnection = env('DB_CONNECTION');
    $dbDatabase = env('DB_DATABASE');
    
    return [
        'env_keys' => $envKeys,
        'server_keys' => $serverKeys,
        'mysql_host_present' => $mysqlHostPresent,
        'DB_CONNECTION' => $dbConnection,
        'DB_DATABASE' => $dbDatabase,
        'APP_ENV' => env('APP_ENV')
    ];
});
Route::post('/checkout', [App\Http\Controllers\Customer\CheckoutController::class, 'store'])->name('customer.checkout');
Route::get('/customer/checkout', [CustomerController::class, 'checkoutForm'])->name('customer.checkout.view');

// Customer Authentication & History
Route::get('/customer/login', [CustomerController::class, 'loginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerController::class, 'loginSubmit'])->name('customer.login.submit');
Route::post('/customer/guest', [CustomerController::class, 'guestSubmit'])->name('customer.guest.submit');
Route::get('/customer/register', [CustomerController::class, 'registerForm'])->name('customer.register');
Route::post('/customer/register', [CustomerController::class, 'registerSubmit'])->name('customer.register.submit');
Route::post('/customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('/customer/history', [CustomerController::class, 'history'])->name('customer.history');

// Checkout (Public)
Route::post('/order/checkout', [App\Http\Controllers\OrderController::class, 'checkout'])->name('order.checkout');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user() && in_array(auth()->user()->role, ['admin', 'superadmin'])) {
            return redirect()->route('admin.dashboard');
        }
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
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // 1. Kelola Menu
    Route::resource('food', App\Http\Controllers\Admin\FoodController::class);

    // 2. Kelola Kategori
    Route::resource('category', App\Http\Controllers\Admin\CategoryController::class);

    // 3. Kelola Transaksi (Pesanan Masuk)
    Route::resource('transaksi', App\Http\Controllers\Admin\TransaksiController::class);

    // 4. Kelola Laporan & Analitik
    Route::get('/laporan', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('laporan.index');

    // 5. Kelola Admin (Hanya Superadmin)
    Route::middleware(['superadmin'])->group(function () {
        Route::resource('user', App\Http\Controllers\Admin\UserController::class);
    });
});

require __DIR__ . '/auth.php';