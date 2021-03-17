<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back\UtilityControllerContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

class UtilityController extends Controller implements UtilityControllerContract
{
    public function getSuggestions(UtilityServiceContract $utilityService, Request $request): SuggestionsResponseContract
    {
        $search = $request->get('q', '') ?? '';
        $type = $request->get('type', '') ?? '';

        $items = $utilityService->getSuggestions($search);

        return resolve(SuggestionsResponseContract::class, compact('items', 'type'));
    }
}
