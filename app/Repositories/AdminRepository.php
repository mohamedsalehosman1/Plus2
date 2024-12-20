<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Collection;

class AdminRepository implements CrudsInterface, BlockInterface, Softdeleteinterface
{

    public function index()
    {
        return Admin::paginate(request("perPage"));
    }
    public function trash()
    {
        return Admin::onlyTrashed()->paginate(request(key: "perPage"));
    }

    public function find($id, $withTrashed = false)
    {
        return Admin::when(fn($q) => $q->withTrashed())->findOrFail($id);
    }

    public function store($data)
    {

        $model =  Admin::create($data);
        $model->addMediaFromRequest('image')->toMediaCollection('images');
        return $model;
    }

    public function update($data, $model)
    {
        if (is_null($data['password'])) {
            unset($data['password']);
        }

        $model->update($data);
        if (isset($data['image'])) {
            $model->clearMediaCollection('images');
            $model->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return $model;
    }
    public function updateProfile($data, $model)
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

    public function forceDelete($model)
    {
        return $model->forceDelete();
    }

    public function restore($model)
    {
        return $model->restore($model);
    }


    public function block($model)
    {
        return $model->update(["blocked_at", now()]);
    }

    public function unblock($model)
    {
        return $model->update(["blocked_at", null]);
    }
}
