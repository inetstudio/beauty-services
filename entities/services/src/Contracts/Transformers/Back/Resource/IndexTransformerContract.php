<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Resource;

use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;

interface IndexTransformerContract
{
    public function transform(ServiceModelContract $item): array;
}
