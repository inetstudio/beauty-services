<?php

namespace InetStudio\BeautyServicesPackage\Services\Transformers\Back\Utility;

use League\Fractal\TransformerAbstract;
use League\Fractal\Resource\Collection as FractalCollection;
use InetStudio\BeautyServicesPackage\Services\Contracts\Models\ServiceModelContract;
use InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Utility\SuggestionTransformerContract;

class SuggestionTransformer extends TransformerAbstract implements SuggestionTransformerContract
{
    protected string $type;

    public function __construct(string $type = '')
    {
        $this->type = $type;
    }

    public function transform(ServiceModelContract $item): array
    {
        return ($this->type === 'autocomplete')
            ? [
                'value' => $item['title'],
                'data' => [
                    'id' => $item['id'],
                    'type' => get_class($item),
                    'title' => $item['title'],
                    'path' => parse_url($item['href'], PHP_URL_PATH),
                    'href' => $item['href'],
                ],
            ]
            : [
                'id' => $item['id'],
                'name' => $item['title'],
            ];
    }

    public function transformCollection($items): FractalCollection
    {
        return new FractalCollection($items, $this);
    }
}
