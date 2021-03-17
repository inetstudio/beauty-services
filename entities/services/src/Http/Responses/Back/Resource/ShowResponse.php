<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource;

use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\ShowResponseContract;

class ShowResponse implements ShowResponseContract
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toResponse($request)
    {
        return response()->json($this->data['item']);
    }
}
