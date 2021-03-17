<?php

namespace InetStudio\BeautyServicesPackage\Services\Models;

use Illuminate\Support\Carbon;
use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use InetStudio\Uploads\Models\Traits\HasImages;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use InetStudio\Classifiers\Models\Traits\HasClassifiers;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\AdminPanel\Base\Models\Traits\Scopes\BuildQueryScopeTrait;

class ServiceModel extends Model implements ServiceModelContract
{
    use Auditable;
    use HasImages;
    use SoftDeletes;
    use HasClassifiers;
    use BuildQueryScopeTrait;

    const ENTITY_TYPE = 'beauty_service';

    const BASE_PROMO_TYPE = 'consultation';

    protected $auditTimestamps = true;

    protected $images = [
        'config' => 'beauty_services',
        'model' => 'service',
    ];

    protected $table = 'beauty_services';

    protected $fillable = [
        'is_main',
        'title',
        'description',
        'href',
        'date_start',
        'date_end',
    ];

    protected $dates = [
        'date_start',
        'date_end',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function boot()
    {
        parent::boot();

        self::$buildQueryScopeDefaults['columns'] = [
            'id',
            'is_main',
            'title',
            'description',
            'href',
            'date_start',
            'date_end',
        ];

        self::$buildQueryScopeDefaults['relations'] = [
            'classifiers' => function (MorphToMany $classifiersQuery) {
                $classifiersQuery->select(
                    [
                        'classifiers_entries.id',
                        'classifiers_entries.value',
                        'classifiers_entries.alias',
                    ]
                );
            },

            'media' => function (MorphMany $mediaQuery) {
                $mediaQuery->select(
                    [
                        'id',
                        'model_id',
                        'model_type',
                        'collection_name',
                        'file_name',
                        'disk',
                        'conversions_disk',
                        'uuid',
                        'mime_type',
                        'custom_properties',
                        'responsive_images',
                    ]
                );
            },
        ];
    }

    public function setIsMainAttribute($value): void
    {
        $this->attributes['is_main'] = (bool) trim(strip_tags($value));
    }

    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = trim(strip_tags($value));
    }

    public function setDescriptionAttribute($value): void
    {
        $value = (isset($value['text'])) ? $value['text'] : (! is_array($value) ? $value : '');

        $this->attributes['description'] = trim(str_replace('&nbsp;', ' ', strip_tags($value)));
    }

    public function setHrefAttribute($value): void
    {
        $this->attributes['href'] = trim(strip_tags($value));
    }

    public function setDateStartAttribute($value): void
    {
        $this->attributes['date_start'] = ($value) ? Carbon::createFromFormat('d.m.Y H:i', $value) : null;
    }

    public function setDateEndAttribute($value): void
    {
        $this->attributes['date_end'] = ($value) ? Carbon::createFromFormat('d.m.Y H:i', $value) : null;
    }

    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    public function getServiceTypeAttribute(): string
    {
        $serviceType = $this->classifiers()->whereHas(
            'groups',
            function ($query) {
                $query->where('alias', '=', 'beauty_services_types');
            }
        )->pluck('alias')->toArray();

        $serviceType = (empty($serviceType))
            ? ($this->attributes['beauty_services_type'] ?: self::BASE_PROMO_TYPE)
            : str_replace('beauty_services_type_', '', $serviceType[0]);

        return $serviceType;
    }

    public function scopeItemsByType(Builder $query, string $type = '', array $params = []): Builder
    {
        $query->buildQuery($params);

        if ($type) {
            $query->whereHas(
                'classifiers',
                function ($classifiersQuery) use ($type) {
                    $classifiersQuery->where('classifiers_entries.alias', $type);
                }
            );
        } else {
            $query->whereHas('classifiers');
        }

        return $query;
    }
}
