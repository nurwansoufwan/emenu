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

        // Only execute database-related bootstrap if not running in CLI/console (prevents build crashes)
        if (!app()->runningInConsole()) {
            // Auto-run migrations and force HTTPS in production
            if (config('app.env') === 'production') {
                \Illuminate\Support\Facades\URL::forceScheme('https');

                try {
                    if (!\Illuminate\Support\Facades\Schema::hasTable('migrations')) {
                        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
                    }

                    // Auto-seed if the database has no categories
                    if (\Illuminate\Support\Facades\Schema::hasTable('categories') && \App\Models\Category::count() === 0) {
                        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
                    }

                    // Auto-link storage if link doesn't exist
                    if (!file_exists(public_path('storage'))) {
                        \Illuminate\Support\Facades\Artisan::call('storage:link');
                    }
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Auto-migration/seeding/linking failed: ' . $e->getMessage());
                }
            }

            // Share pending orders count to sidebar safely
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('transaksis')) {
                    \Illuminate\Support\Facades\View::share('pendingOrdersCount', \App\Models\Transaksi::where('status', 'pending')->count());
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::warning('Could not share pendingOrdersCount: ' . $e->getMessage());
            }
        }
    }

    public const HOME = '/admin/dashboard';
}
