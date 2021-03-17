<?php

namespace InetStudio\BeautyServicesPackage\Services\Console\Commands;

use Illuminate\Console\Command;

class CreateFoldersCommand extends Command
{
    protected $name = 'inetstudio:beauty-services-package:services:folders';

    protected $description = 'Create package folders';

    public function handle(): void
    {
        $folders = [
            'beauty_services',
        ];

        foreach ($folders as $folder) {
            if (config('filesystems.disks.'.$folder)) {
                $path = config('filesystems.disks.'.$folder.'.root');
                $this->createDir($path);
            }
        }
    }

    protected function createDir($path): void
    {
        if (is_dir($path)) {
            $this->info($path.' Already created.');

            return;
        }

        mkdir($path, 0777, true);
        $this->info($path.' Has been created.');
    }
}
