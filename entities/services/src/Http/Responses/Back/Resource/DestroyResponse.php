<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource;

use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\DestroyResponseContract;

class DestroyResponse implements DestroyResponseContract
{
    protected bool $result;

    public function __construct(bool $result)
    {
        $this->result = $result;
    }

    public function toResponse($request)
    {
        return response()->json(
            [
                'success' => $this->result,
            ]
        );
    }
}
