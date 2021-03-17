<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Utility;

use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;

interface SuggestionTransformerContract
{
    public function transform(ServiceModelContract $item): array;

    public function transformCollection($items): FractalCollection;
}
