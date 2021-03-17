<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Responses\Back\Utility;

use League\Fractal\Manager;
use Illuminate\Support\Collection;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Responses\Back\Utility\SuggestionsResponseContract;

class SuggestionsResponse implements SuggestionsResponseContract
{
    protected Collection $items;

    protected string $type;

    public function __construct(Collection $items, string $type = '')
    {
        $this->items = $items;
        $this->type = $type;
    }

    public function toResponse($request)
    {
        $transformer = resolve(
            'InetStudio\BeautyServicesPackage\Services\Contracts\Transformers\Back\Utility\SuggestionTransformerContract',
            [
                'type' => $this->type,
            ]
        );

        $resource = $transformer->transformCollection($this->items);

        $serializer = resolve('InetStudio\AdminPanel\Base\Contracts\Serializers\SimpleDataArraySerializerContract');

        $manager = new Manager();
        $manager->setSerializer($serializer);

        $transformation = $manager->createData($resource)->toArray();

        $data = [
            'suggestions' => [],
            'items' => [],
        ];

        if ($this->type == 'autocomplete') {
            $data['suggestions'] = $transformation;
        } else {
            $data['items'] = $transformation;
        }

        return response()->json($data);
    }
}
