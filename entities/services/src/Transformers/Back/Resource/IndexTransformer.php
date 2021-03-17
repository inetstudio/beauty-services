<?php

namespace InetStudio\BeautyServicesPackage\Services\Transformers\Back\Resource;

use League\Fractal\TransformerAbstract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Resource\IndexTransformerContract;

class IndexTransformer extends TransformerAbstract implements IndexTransformerContract
{
    public function transform(ServiceModelContract $item): array
    {
        return [
            'id' => (int) $item['id'],
            'type' => view(
                    'admin.module.beauty-services.services::back.partials.datatables.classifiers',
                    [
                        'classifiers' => $item['classifiers'],
                    ]
                )->render(),
            'is_main' => view(
                    'admin.module.beauty-services.services::back.partials.datatables.main',
                    [
                        'main' => $item['is_main'],
                    ]
                )->render(),
            'title' => $item['title'],
            'date_start' => (string) $item['date_start'],
            'date_end' => (string) $item['date_end'],
            'created_at' => (string) $item['created_at'],
            'updated_at' => (string) $item['updated_at'],
            'actions' => view(
                    'admin.module.beauty-services.services::back.partials.datatables.actions',
                    [
                        'id' => $item['id'],
                    ]
                )->render(),
        ];
    }
}
