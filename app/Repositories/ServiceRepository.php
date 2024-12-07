<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\ServiceTranslation;

class ServiceRepository implements CrudsInterface
{
    public function index()
    {
        return Service::paginate(request("perPage"));
    }

    public function store($data)
    {
        $service = Service::create([
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        $service->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['name' => $data['name_en']]
        );

        $service->translations()->updateOrCreate(
            ['locale' => 'ar'],
            ['name' => $data['name_ar']]
        );

        return $service;
    }
    public function find($id, $withTrashed = false)
    {
        return Service::when(fn($q) => $q->withTrashed())->findOrFail($id);
    }
    // تحديث الخدمة
    public function update($data, $model)
    {
        $model->update($data);

        foreach (['en', 'ar'] as $locale) {
            $model->translations()->updateOrCreate(
                ['locale' => $locale],
                ['name' => $data["name_{$locale}"]]
            );
        }

        return $model;
    }

    public function destroy($model)
    {
        return $model->delete();
    }
}
