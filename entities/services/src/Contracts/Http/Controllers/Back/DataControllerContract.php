<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back;

use Illuminate\Http\JsonResponse;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\DataTableServiceContract;

interface DataControllerContract
{
    public function data(DataTableServiceContract $dataTableService): JsonResponse;
}
