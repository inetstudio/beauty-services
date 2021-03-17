<?php

namespace InetStudio\BeautyServicesPackage\Services\Providers;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class BindingsServiceProvider extends BaseServiceProvider implements DeferrableProvider
{
    public array $bindings = [
        'InetStudio\BeautyServicesPackage\Services\Contracts\Events\Back\ModifyItemEventContract' => 'InetStudio\BeautyServicesPackage\Services\Events\Back\ModifyItemEvent',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back\ResourceControllerContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Controllers\Back\ResourceController',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back\DataControllerContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Controllers\Back\DataController',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back\UtilityControllerContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Controllers\Back\UtilityController',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Requests\Back\SaveItemRequestContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Requests\Back\SaveItemRequest',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\DestroyResponseContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource\DestroyResponse',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\FormResponseContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource\FormResponse',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\IndexResponseContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource\IndexResponse',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\SaveResponseContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource\SaveResponse',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\ShowResponseContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource\ShowResponse',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract' => 'InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Utility\SuggestionsResponse',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract' => 'InetStudio\BeautyServicesPackage\Services\Models\ServiceModel',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\DataTableServiceContract' => 'InetStudio\BeautyServicesPackage\Services\Services\Back\DataTableService',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\ItemsServiceContract' => 'InetStudio\BeautyServicesPackage\Services\Services\Back\ItemsService',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\UtilityServiceContract' => 'InetStudio\BeautyServicesPackage\Services\Services\Back\UtilityService',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Services\Front\ItemsServiceContract' => 'InetStudio\BeautyServicesPackage\Services\Services\Front\ItemsService',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Resource\IndexTransformerContract' => 'InetStudio\BeautyServicesPackage\Services\Transformers\Back\Resource\IndexTransformer',
        'InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Utility\SuggestionTransformerContract' => 'InetStudio\BeautyServicesPackage\Services\Transformers\Back\Utility\SuggestionTransformer',
    ];

    public function provides()
    {
        return array_keys($this->bindings);
    }
}
