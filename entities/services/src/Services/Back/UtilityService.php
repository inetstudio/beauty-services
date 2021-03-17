<?php

namespace InetStudio\BeautyServicesPackage\Services\Services\Back;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use InetStudio\AdminPanel\Base\Services\BaseService;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Services\Back\UtilityServiceContract;

class UtilityService extends BaseService implements UtilityServiceContract
{
    public function __construct(ServiceModelContract $model)
    {
        parent::__construct($model);
    }

    public function getSuggestions(string $search): Collection
    {
        $now = Carbon::now();

        return $this->model::where(
                [
                    ['title', 'LIKE', '%'.$search.'%'],
                ]
            )
            ->where(function ($query) use ($now) {
                $query->where('date_start', '<=', $now)->orWhereNull('date_start');
            })
            ->where(function ($query) use ($now) {
                $query->where('date_end', '>=', $now)->orWhereNull('date_end');
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
