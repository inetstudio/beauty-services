<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back;

use Illuminate\Http\Request;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\UtilityServiceContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

interface UtilityControllerContract
{
    public function getSuggestions(UtilityServiceContract $utilityService, Request $request): SuggestionsResponseContract;
}
