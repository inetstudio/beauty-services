<?php

namespace InetStudio\BeautyServicesPackage\Services\Contracts\Models;

use OwenIt\Auditing\Contracts\Auditable;
use Spatie\MediaLibrary\HasMedia;
use InetStudio\AdminPanel\Base\Contracts\Models\BaseModelContract;

interface ServiceModelContract extends BaseModelContract, Auditable, HasMedia
{
}
