<?php

namespace InetStudio\BeautyServicesPackage\Services\Services\Front;

use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Front\ItemsServiceContract;

class ItemsService extends BaseService implements ItemsServiceContract
{
    public function __construct(ServiceModelContract $model)
    {
        parent::__construct($model);
    }

    public function getItemsByType(string $type = '', array $params = []): array
    {
        $items = $this->model->itemsByType($type, $params)->get();

        $data = [];

        $items->each(
            function ($item) use (&$data) {
                foreach ($item->classifiers as $type) {
                    $data[$type->alias][] = $item;
                }
            }
        );

        return $data;
    }
}
