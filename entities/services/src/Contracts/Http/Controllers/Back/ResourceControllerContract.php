<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Http\Controllers\Back;

use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\ItemsServiceContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\DataTableServiceContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Requests\Back\SaveItemRequestContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\FormResponseContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\SaveResponseContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\ShowResponseContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\IndexResponseContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

interface ResourceControllerContract
{
    public function index(DataTableServiceContract $dataTableService): IndexResponseContract;

    public function create(ItemsServiceContract $resourceService, string $type = ''): FormResponseContract;

    public function store(ItemsServiceContract $resourceService, SaveItemRequestContract $request): SaveResponseContract;

    public function edit(ItemsServiceContract $resourceService, int $id = 0): FormResponseContract;

    public function update(
        ItemsServiceContract $resourceService,
        SaveItemRequestContract $request,
        int $id = 0
    ): SaveResponseContract;

    public function show(ItemsServiceContract $resourceService, int $id = 0): ShowResponseContract;

    public function destroy(ItemsServiceContract $resourceService, int $id = 0): DestroyResponseContract;
}
