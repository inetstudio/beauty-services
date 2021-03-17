<?php

namespace InetStudio\BeautyServicesPackage\Services\Services\Back;

use Yajra\DataTables\DataTables;
use Illuminate\Http\JsonResponse;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\DataTableServiceContract;

class DataTableService extends DataTable implements DataTableServiceContract
{
    protected ServiceModelContract $model;

    public function __construct(ServiceModelContract $model)
    {
        $this->model = $model;
    }

    public function ajax(): JsonResponse
    {
        $transformer = resolve('InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Resource\IndexTransformerContract');

        return DataTables::of($this->query())
            ->setTransformer($transformer)
            ->rawColumns(['actions'])
            ->make();
    }

    public function query()
    {
        $query = $this->model->buildQuery(
            [
                'columns' => ['created_at', 'updated_at'],
                'relations' => ['classifiers'],
            ]
        );

        return $query;
    }

    public function html(): Builder
    {
        /** @var Builder $table */
        $table = app('datatables.html');

        return $table
            ->columns($this->getColumns())
            ->ajax($this->getAjaxOptions())
            ->parameters($this->getParameters());
    }

    protected function getColumns(): array
    {
        return [
            ['data' => 'type', 'name' => 'classifiers.value', 'title' => 'Тип', 'orderable' => false],
            ['data' => 'is_main', 'name' => 'is_main', 'title' => 'Главный сервис'],
            ['data' => 'title', 'name' => 'title', 'title' => 'Заголовок'],
            ['data' => 'date_start', 'name' => 'date_start', 'title' => 'Дата начала'],
            ['data' => 'date_end', 'name' => 'date_end', 'title' => 'Дата окончания'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
            ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Дата обновления'],
            [
                'data' => 'actions',
                'name' => 'actions',
                'title' => 'Действия',
                'orderable' => false,
                'searchable' => false,
            ],
        ];
    }

    protected function getAjaxOptions(): array
    {
        return [
            'url' => route('back.beauty-services-package.services.data.index'),
            'type' => 'POST',
        ];
    }

    protected function getParameters(): array
    {
        $translation = trans('admin::datatables');

        return [
            'order' => [5, 'desc'],
            'paging' => true,
            'pagingType' => 'full_numbers',
            'searching' => true,
            'info' => false,
            'searchDelay' => 350,
            'language' => $translation,
        ];
    }
}
