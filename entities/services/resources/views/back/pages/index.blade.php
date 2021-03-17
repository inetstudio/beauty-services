@extends('admin::back.layouts.app')

@php
    $title = 'Сервисы';
@endphp

@section('title', $title)

@section('content')

    @push('breadcrumbs')
        @include('admin.module.beauty-services.services::back.partials.breadcrumbs.index')
    @endpush

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <div class="btn-group">
                            <button data-toggle="dropdown" class="btn btn-sm btn-primary btn-lg dropdown-toggle">Добавить</button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('back.beauty-services-package.services.create', ['type' => 'skin']) }}">Кожа</a></li>
                                <li><a href="{{ route('back.beauty-services-package.services.create', ['type' => 'hair']) }}">Волосы</a></li>
                                <li><a href="{{ route('back.beauty-services-package.services.create', ['type' => 'makeup']) }}">Макияж</a></li>
                                <li><a href="{{ route('back.beauty-services-package.services.create', ['type' => 'color']) }}">Окрашивание</a></li>
                                <li><a href="{{ route('back.beauty-services-package.services.create', ['type' => 'consultation']) }}">Онлайн-консультация</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            {{ $table->table(['class' => 'table table-striped table-bordered table-hover dataTable']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@pushonce('scripts:datatables_beauty_services_services_index')
    {!! $table->scripts() !!}
@endpushonce
