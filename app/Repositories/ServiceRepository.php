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
        $model =Service::create( $data);
        $model->addMedia($data['image'])->toMediaCollection('images');
        return $model;
    }
    public function find($id, $withTrashed = false)
    {
        return Service::when(fn($q) => $q->withTrashed())->findOrFail($id);
    }
    public function update($data, $model)
    {
        $model->update($data);
        if (isset($data['image'])) {
            $model->clearMediaCollection('images');
            $model->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return $model;
    }

    public function destroy($model)
    {
        return $model->delete();
    }
}
