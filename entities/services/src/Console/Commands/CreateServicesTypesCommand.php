<?php

namespace InetStudio\BeautyServicesPackage\Services\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Container\BindingResolutionException;

class CreateServicesTypesCommand extends Command
{
    protected $name = 'inetstudio:beauty-services-package:services:types';

    protected $description = 'Create classifiers beauty services type';

    public function handle(): void
    {
        $groupsService = app()->make('InetStudio\Classifiers\Groups\Contracts\Services\Back\ItemsServiceContract');

        if (DB::table('classifiers_groups')->where('alias', 'beauty_services_types')->count() == 0) {
            $now = Carbon::now()->format('Y-m-d H:m:s');

            $group = $groupsService->getModel()::updateOrCreate(
                [
                    'name' => 'Тип сервиса красоты',
                ],
                [
                    'alias' => 'beauty_services_types',
                ]
            );

            $ids = [];

            $ids[] = DB::connection('mysql')->table('classifiers_entries')->insertGetId(
                [
                    'value' => 'Кожа',
                    'alias' => 'beauty_services_type_skin',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $ids[] = DB::connection('mysql')->table('classifiers_entries')->insertGetId(
                [
                    'value' => 'Волосы',
                    'alias' => 'beauty_services_type_hair',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $ids[] = DB::connection('mysql')->table('classifiers_entries')->insertGetId(
                [
                    'value' => 'Макияж',
                    'alias' => 'beauty_services_type_makeup',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $ids[] = DB::connection('mysql')->table('classifiers_entries')->insertGetId(
                [
                    'value' => 'Окрашивание',
                    'alias' => 'beauty_services_type_color',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $ids[] = DB::connection('mysql')->table('classifiers_entries')->insertGetId(
                [
                    'value' => 'Онлайн-консультация',
                    'alias' => 'beauty_services_type_consultation',
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $group->entries()->attach($ids);
        }
    }
}
