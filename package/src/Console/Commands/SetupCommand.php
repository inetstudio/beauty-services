<?php

namespace InetStudio\BeautyServicesPackage\Console\Commands;

use InetStudio\AdminPanel\Base\Console\Commands\BaseSetupCommand;

class SetupCommand extends BaseSetupCommand
{
    protected $name = 'inetstudio:beauty-services-package:setup';

    protected $description = 'Setup beauty service package';

    protected function initCommands(): void
    {
        $this->calls = [
            [
                'type' => 'artisan',
                'description' => 'Beauty service setup',
                'command' => 'inetstudio:beauty-services-package:services:setup',
            ],
        ];
    }
}
