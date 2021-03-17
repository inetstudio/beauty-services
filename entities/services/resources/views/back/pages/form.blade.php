@extends('admin::back.layouts.app')

@php
    $title = ($item->id) ? 'Редактирование сервиса' : 'Создание сервиса';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.beauty-services.services::back.partials.breadcrumbs.form')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <a class="btn btn-sm btn-white m-r-xs" href="{{ route('back.beauty-services-package.services.index') }}">
                    <i class="fa fa-arrow-left"></i> Вернуться назад
                </a>
            </div>
        </div>

        {!! Form::info() !!}

        {!! Form::open(['url' => (! $item->id) ? route('back.beauty-services-package.services.store') : route('back.beauty-services-package.services.update', [$item->id]), 'id' => 'mainForm', 'enctype' => 'multipart/form-data']) !!}

        @if ($item->id)
            {{ method_field('PUT') }}
        @endif

        {!! Form::hidden('service_id', (! $item->id) ? '' : $item->id, ['id' => 'object-id']) !!}

        {!! Form::hidden('service_obj_type', get_class($item), ['id' => 'object-type']) !!}

        <div class="ibox">
            <div class="ibox-title">
                {!! Form::buttons('', '', ['back' => 'back.beauty-services-package.services.index']) !!}
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel-group float-e-margins" id="mainAccordion">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#mainAccordion" href="#collapseMain"
                                           aria-expanded="true">Основная информация</a>
                                    </h5>
                                </div>
                                <div id="collapseMain" class="collapse show" aria-expanded="true">
                                    <div class="panel-body">

                                        {!! Form::classifiers('', $item, [
                                            'label' => [
                                                'title' => 'Тип сервиса',
                                            ],
                                            'field' => [
                                                'placeholder' => 'Выберите тип сервиса',
                                                'group' => 'beauty_services_types',
                                                'multiple' => false,
                                                'readonly' => true,
                                                'default' => 'beauty_services_type_'.$item->service_type,
                                            ],
                                        ]) !!}

                                        {!! Form::hidden('is_main', 0) !!}
                                        {!! Form::checks('is_main', $item->is_main, [
                                            'label' => [
                                                'title' => 'Главный сервис',
                                            ],
                                            'checks' => [
                                                [
                                                    'value' => 1,
                                                ],
                                            ],
                                        ]) !!}

                                        {!! Form::string('title', $item->title, [
                                            'label' => [
                                                'title' => 'Заголовок',
                                            ],
                                        ]) !!}

                                        @php
                                            $previewImageMedia = $item->getFirstMedia('preview');
                                            $previewCrops = config('beauty_services.images.crops.service.preview') ?? [];

                                            foreach ($previewCrops as &$previewCrop) {
                                                $previewCrop['value'] = isset($previewImageMedia) ? $previewImageMedia->getCustomProperty('crop.'.$previewCrop['name']) : '';
                                            }
                                        @endphp

                                        {!! Form::crop('preview', $previewImageMedia, [
                                            'label' => [
                                                'title' => 'Превью',
                                            ],
                                            'image' => [
                                                'filepath' => isset($previewImageMedia) ? url($previewImageMedia->getUrl()) : '',
                                                'filename' => isset($previewImageMedia) ? $previewImageMedia->file_name : '',
                                            ],
                                            'crops' => $previewCrops,
                                            'additional' => [],
                                        ]) !!}

                                        @php
                                            $mainPreviewImageMedia = $item->getFirstMedia('main_preview');
                                            $mainPreviewCrops = config('beauty_services.images.crops.service.main_preview') ?? [];

                                            foreach ($mainPreviewCrops as &$mainPreviewCrop) {
                                                $mainPreviewCrop['value'] = isset($mainPreviewImageMedia) ? $mainPreviewImageMedia->getCustomProperty('crop.'.$mainPreviewCrop['name']) : '';
                                            }
                                        @endphp

                                        <div class="is-main" {!! ($item->is_main == 0) ? 'style="display: none"' : '' !!}>
                                            {!! Form::crop('main_preview', $mainPreviewImageMedia, [
                                                'label' => [
                                                    'title' => 'Главное изображение',
                                                ],
                                                'image' => [
                                                    'filepath' => isset($mainPreviewImageMedia) ? url($mainPreviewImageMedia->getUrl()) : '',
                                                    'filename' => isset($mainPreviewImageMedia) ? $mainPreviewImageMedia->file_name : '',
                                                ],
                                                'crops' => $mainPreviewCrops,
                                                'additional' => [],
                                            ]) !!}
                                        </div>

                                        {!! Form::wysiwyg('description', $item->description, [
                                            'label' => [
                                                'title' => 'Описание',
                                            ],
                                            'field' => [
                                                'class' => 'tinymce-simple',
                                                'type' => 'simple',
                                                'id' => 'description',
                                            ],
                                        ]) !!}

                                        {!! Form::string('href', $item->href, [
                                            'label' => [
                                                'title' => 'Ссылка',
                                            ],
                                        ]) !!}

                                        {!! Form::datepicker('date_start', ($item->date_start) ? $item->date_start->format('d.m.Y H:i') : '', [
                                            'label' => [
                                                'title' => 'Дата начала',
                                            ],
                                            'field' => [
                                                'class' => 'datetimepicker form-control',
                                                'autocomplete' => 'off'
                                            ],
                                        ]) !!}

                                        {!! Form::datepicker('date_end', ($item->date_end) ? $item->date_end->format('d.m.Y H:i') : '', [
                                            'label' => [
                                                'title' => 'Дата окончания',
                                            ],
                                            'field' => [
                                                'class' => 'datetimepicker form-control',
                                                'autocomplete' => 'off'
                                            ],
                                        ]) !!}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ibox-footer">
                {!! Form::buttons('', '', ['back' => 'back.beauty-services-package.services.index']) !!}
            </div>
        </div>

        {!! Form::close()!!}
    </div>
@endsection
