<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource;

use Illuminate\Http\Request;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\SaveResponseContract;

class SaveResponse implements SaveResponseContract
{
    protected ServiceModelContract $item;

    public function __construct(ServiceModelContract $item)
    {
        $this->item = $item;
    }

    public function toResponse($request)
    {
        $item = $this->item->fresh();

        return response()->redirectToRoute(
            'back.beauty-services-package.services.edit',
            [
                $item['id'],
            ]
        );
    }
}
