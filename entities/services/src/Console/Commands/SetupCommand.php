<?php

namespace InetStudio\BeautyServicesPackage\Services\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

class SetupCommand extends BaseSetupCommand
{
    protected $name = 'inetstudio:beauty-services-package:services:setup';

    protected $description = 'Setup beauty services package';

    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Publish migrations',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\BeautyServicesPackage\Services\Providers\ServiceProvider',
                    '--tag' => 'migrations',
                ],
            ],
            [
                'type' => 'artisan',
                'description' => 'Migration',
                'command' => 'migrate',
            ],
            [
                'type' => 'artisan',
                'description' => 'Create folders',
                'command' => 'inetstudio:beauty-services-package:services:folders',
            ],
            [
                'type' => 'artisan',
                'description' => 'Create beauty services types',
                'command' => 'inetstudio:beauty-services-package:services:types',
            ],
            [
                'type' => 'artisan',
                'description' => 'Publish config',
                'command' => 'vendor:publish',
                'params' => [
                    '--provider' => 'InetStudio\BeautyServicesPackage\Services\Providers\ServiceProvider',
                    '--tag' => 'config',
                ],
            ],
        ];
    }
}
