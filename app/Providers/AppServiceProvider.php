<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
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
        if (! $this->app->runningInConsole() || app()->runningUnitTests()) {
            try {
                if (Schema::hasTable('settings')) {
                    $settings = Setting::all()->pluck('value', 'key')->toArray();
                    view()->share('appSettings', $settings);
                }
            } catch (\Throwable $e) {
                // Ignore during early boot/migrations
            }
        }
    }
}
