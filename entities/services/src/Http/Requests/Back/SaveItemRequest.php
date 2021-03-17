<?php

namespace InetStudio\BeautyServicesPackage\Services\Http\Requests\Back;

use Illuminate\Foundation\Http\FormRequest;
use InetStudio\Uploads\Validation\Rules\CropSize;
use Illuminate\Contracts\Container\BindingResolutionException;
use InetStudio\BeautyServicesPackage\Services\Contracts\Http\Requests\Back\SaveItemRequestContract;

class SaveItemRequest extends FormRequest implements SaveItemRequestContract
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        $previewCrops = config('beauty_services.images.crops.service.preview') ?? [];

        $cropMessages = [];

        foreach ($previewCrops as $previewCrop) {
            $cropMessages['preview.crop.'.$previewCrop['name'].'.required'] = 'Необходимо выбрать область отображения '.$previewCrop['ratio'];
            $cropMessages['preview.crop.'.$previewCrop['name'].'.json'] = 'Область отображения '.$previewCrop['ratio'].' должна быть представлена в виде JSON';
        }

        return array_merge(
            [
                'classifiers.required' => 'Поле «Тип промо» обязательно для заполнения',
                'classifiers.array' => 'Поле «Тип промо» содержит значение в некорректном формате',

                'is_main.integer' => 'Поле содержит значение в некорректном формате',

                'title.required' => 'Поле «Заголовок» обязательно для заполнения',
                'title.max' => 'Поле «Заголовок» не должно превышать 255 символов',

                'description.text.required' => 'Поле «Описание» обязательно для заполнения',

                'href.required' => 'Поле «Ссылка» обязательно для заполнения',
                'href.max' => 'Поле «Ссылка» не должно превышать 255 символов',
                'href.url' => 'Поле «Ссылка» содержит значение в некорректном формате',

                'date_start.date_format' => 'Поле «Дата начала» должно быть в формате дд.мм.гггг чч:мм',

                'date_end.date_format' => 'Поле «Дата окончания» должно быть в формате дд.мм.гггг чч:мм',
                'date_end.after_or_equal' => 'Поле «Дата окончания» не должно быть раньше даты начала',
            ],
            $cropMessages
        );
    }

    public function rules(): array
    {
        $rules = [
            'classifiers' => 'required|array',
            'is_main' => 'integer',
            'title' => 'required|max:255',
            'description.text' => 'required',
            'href' => 'required|max:1000|url',
            'date_start' => 'nullable|date_format:d.m.Y H:i',
            'date_end' => 'nullable|date_format:d.m.Y H:i|after_or_equal:date_start',
        ];

        $previewCrops = config('beauty_services.images.crops.service.preview') ?? [];

        $cropRules = [];

        foreach ($previewCrops as $previewCrop) {
            $cropRules['preview.crop.'.$previewCrop['name']] = [
                'nullable',
                'json',
                new CropSize(
                    $previewCrop['size']['width'], $previewCrop['size']['height'], $previewCrop['size']['type'],
                    $previewCrop['ratio']
                ),
            ];
        }

        $rules = array_merge(
            $rules,
            $cropRules
        );

        return $rules;
    }
}
