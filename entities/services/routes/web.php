<?php

use Illuminate\Support\Facades\Route;

Route::group(
    [
        'namespace' => 'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back',
        'middleware' => ['web', 'back.auth'],
        'prefix' => 'back/beauty-services-package',
    ],
    function () {
        Route::any('services/data', 'DataControllerContract@data')
            ->name('back.beauty-services-package.services.data.index');

        Route::post('services/suggestions', 'UtilityControllerContract@getSuggestions')
            ->name('back.beauty-services-package.services.getSuggestions');

        Route::get('services/create/{type?}', 'ResourceControllerContract@create')->name('back.beauty-services-package.services.create');
        Route::resource(
            'services', 'ResourceControllerContract',
            [
                'except' => [
                    'create',
                ],
                'as' => 'back.beauty-services-package',
            ]
        );
    }
);
