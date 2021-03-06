<?php

namespace InetStudio\BeautyServicesPackage\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot(): void
    {
        $this->registerConsoleCommands();
    }

    protected function registerConsoleCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands(
            [
                'InetStudio\BeautyServicesPackage\Console\Commands\SetupCommand',
            ]
        );
    }
}
