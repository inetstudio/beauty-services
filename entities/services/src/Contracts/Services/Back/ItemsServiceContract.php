<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back;

use InetStudio\AdminPanel\Base\Contracts\Services\BaseServiceContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;

interface ItemsServiceContract extends BaseServiceContract
{
    public function save(array $data, int $id): ServiceModelContract;
}
