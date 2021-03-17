<?php

namespace InetStudio\BeautyServicesPackage\Services\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->registerConsoleCommands();
        $this->registerPublishes();
        $this->registerRoutes();
        $this->registerViews();
    }

    protected function registerConsoleCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(
            [
                'InetStudio\BeautyServicesPackage\Services\Console\Commands\SetupCommand',
                'InetStudio\BeautyServicesPackage\Services\Console\Commands\CreateFoldersCommand',
                'InetStudio\BeautyServicesPackage\Services\Console\Commands\CreateServicesTypesCommand',
            ]
        );
    }

    protected function registerPublishes(): void
    {
        $this->publishes(
            [
                __DIR__.'/../../config/beauty_services.php' => config_path('beauty_services.php'),
            ],
            'config'
        );

        $this->mergeConfigFrom(
            __DIR__.'/../../config/filesystems.php',
            'filesystems.disks'
        );

        if (! $this->app->runningInConsole()) {
            return;
        }

        if (Schema::hasTable('beauty_services')) {
            return;
        }

        $timestamp = date('Y_m_d_His', time());
        $this->publishes(
            [
                __DIR__.'/../../database/migrations/create_beauty_services_tables.php.stub' => database_path(
                    'migrations/'.$timestamp.'_create_beauty_services_tables.php'
                ),
            ], 'migrations'
        );
    }

    protected function registerRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
    }

    protected function registerViews(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'admin.module.beauty-services.services');
    }
}
