<?php

namespace InetStudio\BeautyServicesPackage\Services\Services\Back;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\ItemsServiceContract;

class ItemsService extends BaseService implements ItemsServiceContract
{
    public function __construct(ServiceModelContract $model)
    {
        parent::__construct($model);
    }

    public function save(array $data, int $id): ServiceModelContract
    {
        $action = ($id) ? 'отредактирован' : 'создан';

        $itemData = Arr::only($data, $this->model->getFillable());
        $item = $this->saveModel($itemData, $id);

        $classifiersData = Arr::get($data, 'classifiers', []);
        resolve('InetStudio\Classifiers\Entries\Contracts\Services\Back\ItemsServiceContract')
            ->attachToObject($classifiersData, $item);

        $images = (config('beauty_services.images.conversions.service')) ? array_keys(config('beauty_services.images.conversions.service')) : [];
        resolve('InetStudio\Uploads\Contracts\Services\Back\ImagesServiceContract')
            ->attachToObject(request(), $item, $images, 'beauty_services', 'service');

        event(
            resolve(
                'InetStudio\BeautyServicesPackage\Services\Contracts\Events\Back\ModifyItemEventContract',
                compact('item')
            )
        );

        Session::flash('success', 'Сервис «'.$item->title.'» успешно '.$action);

        return $item;
    }
}
