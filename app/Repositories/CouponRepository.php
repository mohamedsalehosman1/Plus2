<?php
namespace App\Repositories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Collection;

class CouponRepository implements CrudsInterface , SoftdeleteInterface
{
<<<<<<< HEAD
    public function index($vendor_id = null)
    {
        if ($vendor_id) {
            return Coupon::where('vendor_id', $vendor_id)->get();
        }

        return Coupon::all();
=======
    public function index($search = null, $vendorId = null)
    {
        return Coupon::when($search, function ($query) use ($search) {
            return $query->where('code', 'like', '%' . $search . '%');
        })
        ->when($vendorId, function ($query) use ($vendorId) {
            return $query->where('vendor_id', $vendorId);
        })
        ->paginate(request('perPage'));
>>>>>>> 9e2279537b289d0f00b42cf0fbacd6ada7f13c9b
    }

    public function store($data)
    {
        Coupon::where('vendor_id', $data['vendor_id'])
            ->update(['is_active' => false]);

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
        return Coupon::onlyTrashed()->paginate(request('perPage'));
    }

    public function find($id, $withTrashed = false)
    {
        return Coupon::when($withTrashed, function ($q) {
            return $q->withTrashed();
        })->findOrFail($id);
    }

    public function restore($model)
    {
        return $model->restore();
    }

    public function updateStatus(Coupon $coupon)
    {
        if (!$coupon->is_active) {
            Coupon::where('vendor_id', $coupon->vendor_id)
                ->update(['is_active' => false]);
        }

        $coupon->is_active = !$coupon->is_active;
        return $coupon->save();
    }
}
