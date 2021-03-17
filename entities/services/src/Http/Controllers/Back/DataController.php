<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use InetStudio\AdminPanel\Base\Http\Controllers\Controller;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\DataTableServiceContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back\DataControllerContract;

class DataController extends Controller implements DataControllerContract
{
    public function data(DataTableServiceContract $dataTableService): JsonResponse
    {
        return $dataTableService->ajax();
    }
}
