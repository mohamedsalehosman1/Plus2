<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepositories implements CrudsInterface
{

    public function index()
    {
        return Role::paginate(request("perPage"));
    }
    public function trash()
    {
        return Role::onlyTrashed()->paginate(request("perPage"));
    }

    public function find($id, $withTrashed = false)
    {
        return Role::when(fn($q) => $q->withTrashed())->findOrFail($id);
    }

    public function store($data)
    {
        return Role::create($data);
    }

    public function update($data, $model)
    {
        return $model->update($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }
}
