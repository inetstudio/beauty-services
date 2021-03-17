<?php

return [

    /*
     * Настройки изображений
     */

    'images' => [
        'quality' => 75,
        'conversions' => [
            'service' => [
                'preview' => [
                    '510_340' => [
                        [
                            'name' => 'preview_510_340',
                            'size' => [
                                'width' => 510,
                                'height' => 340,
                            ],
                        ],
                    ],
                    '750_500' => [
                        [
                            'name' => 'preview_750_500',
                            'size' => [
                                'width' => 750,
                                'height' => 500,
                            ],
                        ],
                    ],
                ],
                'main_preview' => [
                    '1280_400' => [
                        [
                            'name' => 'main_preview_1280_400',
                            'size' => [
                                'width' => 1280,
                                'height' => 400,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'crops' => [
            'service' => [
                'preview' => [
                    [
                        'title' => 'Выбрать область 510x340',
                        'name' => '510_340',
                        'ratio' => '510/340',
                        'size' => [
                            'width' => 510,
                            'height' => 340,
                            'type' => 'min',
                            'description' => 'Минимальный размер области — 510x340 пикселей',
                        ],
                    ],
                    [
                        'title' => 'Выбрать область 750x500',
                        'name' => '750_500',
                        'ratio' => '750/500',
                        'size' => [
                            'width' => 750,
                            'height' => 500,
                            'type' => 'min',
                            'description' => 'Минимальный размер области — 750x500 пикселей',
                        ],
                        'class' => 'is-main',
                    ],
                ],
                'main_preview' => [
                    [
                        'title' => 'Выбрать область 1280x400',
                        'name' => '1280_400',
                        'ratio' => '1280/400',
                        'size' => [
                            'width' => 1280,
                            'height' => 400,
                            'type' => 'min',
                            'description' => 'Минимальный размер области — 1280x400 пикселей',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
