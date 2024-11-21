<?php

namespace App\Repositories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Collection;

class CouponRepository implements CrudsInterface , Softdeleteinterface

{

    public function index()
    {
        return Coupon::paginate(request("perPage"));
    }

    public function store($data)
    {
        return Coupon::create($data);
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
    public function trash()
    {
        return Coupon::onlyTrashed()->paginate(request(key: "perPage"));
    }

    public function find($id, $withTrashed = false)
    {
        return Coupon::when(fn($q) => $q->withTrashed())->findOrFail($id);
    }

    public function restore($model)
    {
        return $model->restore($model);
    }



}
