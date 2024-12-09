<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceTranslation;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $rootService = Service::create([
            'parent_id' => null,  // No parent, it's a root service
        ]);

        $childService1 = Service::create([
            'parent_id' => $rootService->id,
        ]);

        $childService2 = Service::create([
            'parent_id' => $rootService->id,
        ]);

        $grandchildService = Service::create([
            'parent_id' => $childService1->id,
        ]);


        ServiceTranslation::create([
            'locale' => 'en',
            'name' => 'Root Service',
            'service_id' => $rootService->id,
        ]);

        ServiceTranslation::create([
            'locale' => 'ar',
            'name' => 'الخدمة الرئيسية',
            'service_id' => $rootService->id,
        ]);

        ServiceTranslation::create([
            'locale' => 'en',
            'name' => 'Child Service 1',
            'service_id' => $childService1->id,
        ]);

        ServiceTranslation::create([
            'locale' => 'ar',
            'name' => 'الخدمة الفرعية 1',
            'service_id' => $childService1->id,
        ]);

        ServiceTranslation::create([
            'locale' => 'en',
            'name' => 'Child Service 2',
            'service_id' => $childService2->id,
        ]);

        ServiceTranslation::create([
            'locale' => 'ar',
            'name' => 'الخدمة الفرعية 2',
            'service_id' => $childService2->id,
        ]);

        // For grandchild service
        ServiceTranslation::create([
            'locale' => 'en',
            'name' => 'Grandchild Service',
            'service_id' => $grandchildService->id,
        ]);

        ServiceTranslation::create([
            'locale' => 'ar',
            'name' => 'الخدمة الفرعية الصغيرة',
            'service_id' => $grandchildService->id,
        ]);
    }
}
