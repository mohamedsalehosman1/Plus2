<?php

namespace App\Http\Controllers;

use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use App\Models\Vendor;
use App\Repositories\CouponRepository;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    private $repository;

    public function __construct(CouponRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $coupons = Coupon::all();
        return view('coupons.index', get_defined_vars());
    }

    public function create()
    {
        $vendors = Vendor::all();
        return view('coupons.create', get_defined_vars());
    }

    public function store(CouponRequest $request)
    {
        if ($request->is_active) {
            Coupon::where('vendor_id', $request->vendor_id)
                ->update(['is_active' => false]);
        }

        $vendorId = auth('vendors')->check() ? auth('vendors')->user()->id : $request->vendor_id;

        $coupon_route = auth('admins')->user() ? 'coupons' : 'vendors.coupons';

        $coupon = $this->repository->store($request->validated());
        return redirect()->route(route: "$coupon_route.index")->with('success', __('Coupon Added successfully.'));
    }

    public function show(Coupon $coupon) {}

    public function edit(Coupon $coupon)
    {
        $vendors = Vendor::all();
        return view('coupons.edit', get_defined_vars());
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        if ($request->is_active) {
            Coupon::where('vendor_id', $coupon->vendor_id)
                ->where('id', '!=', $coupon->id)
                ->update(['is_active' => false]);
        }

        $coupon_route = auth('admins')->user() ? 'coupons' : 'vendors.coupons';

        $coupon = $this->repository->update($request->validated(), $coupon);
        return redirect()->route("$coupon_route.index")->with('success', __('Coupon Updated successfully.'));
    }

    public function destroy(Coupon $coupon)
    {
        $coupon_route = auth('admins')->user() ? 'coupons' : 'vendors.coupons';

        $this->repository->destroy($coupon);
        return redirect()->route("$coupon_route.index")->with('success', __('Coupon Deleted successfully.'));
    }

    public function updateStatus($couponId)
    {
        $coupon = Coupon::findOrFail($couponId);

        if (!$coupon->is_active) {
            Coupon::where('vendor_id', $coupon->vendor_id)
                ->update(['is_active' => false]);

            $coupon->is_active = true;
            $coupon->save();
        } else {
            $coupon->is_active = false;
            $coupon->save();
        }

        return redirect()->route('coupons.index')->with('success', 'Coupon status updated successfully.');
    }
}
