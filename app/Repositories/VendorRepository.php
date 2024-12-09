<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

class VendorRepository implements CrudsInterface, BlockInterface, Softdeleteinterface
{

    public function index()
    {
        return Vendor::paginate(request("perPage"));
    }
    public function trash()
    {
        return Vendor::onlyTrashed()->paginate(request(key: "perPage"));
    }

    public function find($id, $withTrashed = false)
    {
        return Vendor::when(fn($q) => $q->withTrashed())->findOrFail($id);
    }

    public function store($data)
    {
        $model = Vendor::create($data);

        $role = Role::where('name', 'vendor')->first();

        if ($role) {
            $model->roles()->syncWithoutDetaching([$role->id]);
        }

        $model->addMedia($data['image'])->toMediaCollection('images');

        return $model;
    }

    public function update($data, $model)
    {


        return $model->update($data);
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
