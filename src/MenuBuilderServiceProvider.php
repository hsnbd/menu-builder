<?php

namespace Softbd\MenuBuilder;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class MenuBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->bind('audit-logger', function($app) {
            return new MenuBuilder();
        });

        $this->mergeConfigFrom(__DIR__.'/config/config.php', 'menu-builder');
        $this->loadHelpers();
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/config/config.php' => config_path('menu-builder.php'),
            ], 'config');
        }
    }

    /**
     * Load helpers.
     */
    protected function loadHelpers()
    {
        require_once __DIR__ . '/helpers/helper.php';
    }
}
