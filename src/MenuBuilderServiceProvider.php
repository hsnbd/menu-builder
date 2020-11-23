<?php

namespace Softbd\MenuBuilder;

use Illuminate\Support\ServiceProvider;

class MenuBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register()
    {
        $this->app->singleton('menu-builder', static function () {
            return new MenuBuilder();
        });

        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'menu-builder');

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
                __DIR__ . '/config/config.php' => config_path('menu-builder.php'),
            ], 'config');
        }

        $this->loadViews();
        $this->loadRoute();
        $this->loadMigrations();
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(config('menu-builder.view_path'), 'menu-builder');
    }

    protected function loadHelpers()
    {
        require_once __DIR__ . '/helpers/helper.php';
    }

    protected function loadRoute()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'migrations');
    }
}
