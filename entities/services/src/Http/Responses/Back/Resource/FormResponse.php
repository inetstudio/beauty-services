<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Resource;

use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Resource\FormResponseContract;

class FormResponse implements FormResponseContract
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toResponse($request)
    {
        return view('admin.module.beauty-services.services::back.pages.form', $this->data);
    }
}
