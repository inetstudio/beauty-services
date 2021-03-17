<?php

namespace InetStudio\BeautyServicesPackage\Services\Events\Back;

use Illuminate\Queue\SerializesModels;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Events\Back\ModifyItemEventContract;

class ModifyItemEvent implements ModifyItemEventContract
{
    use SerializesModels;

    public ServiceModelContract $item;

    public function __construct(ServiceModelContract $item)
    {
        $this->item = $item;
    }
}
