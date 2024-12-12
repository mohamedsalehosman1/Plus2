<?php

namespace App\Repositories;

use App\Models\Ad;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

class AdRepository implements CrudsInterface
{
    public function index($vendor_id = null)
    {
        return Ad::when(auth('vendors')->user(), function ($q) {
            $q->where('vendor_id', auth('vendors')->user()->id);
        })->get();
    }

    public function store($data)
    {
        $model = Ad::create($data);


        $model->addMedia($data['image'])->toMediaCollection('images');


        return $model;
    }

    public function update($data, $model)
    {

        if (isset($data['image'])) {
            $model->clearMediaCollection('images');
            $model->addMediaFromRequest('image')->toMediaCollection('images');
        }
        return $model->update($data);
    }

    public function destroy($model)
    {
        return $model->delete();
    }

    public function trash()
    {
        return Ad::onlyTrashed()->paginate(request('perPage'));
    }

    public function find($id, $withTrashed = false)
    {

        return Ad::when($withTrashed, function ($q) {
            return $q->withTrashed();
        })->findOrFail($id);
    }

    public function restore($model)
    {
        return $model->restore();
    }

    public function updateStatus($data, $model)
    {
        if (!$Ad->status) {
            Ad::where('vendor_id', $Ad->vendor_id)
                ->update(['status' => false]);
        }

        $Ad->status = !$Ad->status;
        return $Ad->save();
    }
}
