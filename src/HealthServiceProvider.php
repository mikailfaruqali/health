<?php

namespace Snawbar\Health;

use Illuminate\Support\ServiceProvider;
use Snawbar\Health\Commands\HealthCommand;

class HealthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'health');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/health.php' => config_path('snawbar-health.php'),
            ], 'health-config');

            $this->commands([
                HealthCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/health.php', 'snawbar-health',
        );
    }
}
