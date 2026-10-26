<?php

namespace App\Providers;

use App\Servieces\SettingService;
use Illuminate\Support\ServiceProvider;

class SettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SettingService::class, fn () => new SettingService);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $settings = $this->app->make(SettingService::class);
        $settings->setSettings();
    }
}
