<?php

namespace Softbd\MenuBuilder;

use Illuminate\Support\ServiceProvider;

class MenuBuilderServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('menu-builder', static function () {
            return new MenuBuilder();
        });

        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'menu-builder');

        $this->loadHelpers();

        $this->loadDiskFileConfig();
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(): void
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

    protected function loadViews(): void
    {
        $this->loadViewsFrom(config('menu-builder.view_path'), 'menu-builder');
    }

    protected function loadHelpers(): void
    {
        require_once __DIR__ . '/helpers/helper.php';
    }

    protected function loadRoute(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'migrations');
    }

    protected function loadDiskFileConfig(): void
    {
        if (!config('filesystems.disks.menu-builder-json-local')) {
            $this->app['config']["filesystems.disks.menu-builder-json-local"] = [
                'driver' => 'local',
                'root' => __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'json-db',
                'permissions' => [
                    'file' => [
                        'public' => 0664,
                        'private' => 0600,
                    ],
                    'dir' => [
                        'public' => 0775,
                        'private' => 0700,
                    ],
                ],
            ];
        }
    }
}
