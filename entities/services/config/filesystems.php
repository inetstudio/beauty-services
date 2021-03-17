<?php

return [

    /*
     * Расширение файла конфигурации app/config/filesystems.php
     * добавляет локальные диски для хранения изображений сервисов
     */

    'beauty_services' => [
        'driver' => 'local',
        'root' => storage_path('app/public/beauty_services'),
        'url' => env('APP_URL').'/storage/beauty_services',
        'visibility' => 'public',
    ],

];
