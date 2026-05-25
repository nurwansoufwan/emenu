<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Trust Proxies (Penting untuk Localtunnel)
        \Illuminate\Support\Facades\Request::setTrustedProxies(
            ['*'], 
            \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR | 
            \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST | 
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT | 
            \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO
        );

        // Auto-run migrations and force HTTPS in production
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');

            try {
                if (!\Illuminate\Support\Facades\Schema::hasTable('migrations')) {
                    \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Auto-migration failed: ' . $e->getMessage());
            }
        }

        // Share pending orders count to sidebar
        if (\Illuminate\Support\Facades\Schema::hasTable('transaksis')) {
            \Illuminate\Support\Facades\View::share('pendingOrdersCount', \App\Models\Transaksi::where('status', 'pending')->count());
        }
    }

    public const HOME = '/admin/dashboard';
}
