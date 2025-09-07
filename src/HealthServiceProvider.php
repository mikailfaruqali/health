<?php

namespace Snawbar\Health;

use Illuminate\Support\ServiceProvider;

class HealthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'health');

        $this->publishes([
            __DIR__ . '/../config/health.php' => config_path('snawbar-health.php'),
        ], 'health-config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/health.php', 'snawbar-health',
        );
    }
}
