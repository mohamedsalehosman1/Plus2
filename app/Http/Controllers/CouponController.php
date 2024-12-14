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

    public function index(Request $request)
    {
        $vendor_id = $request->get('vendor_id', auth('vendors')->check() ? auth('vendors')->user()->id : null);

        $coupons = $this->repository->index($vendor_id );

        return view('coupons.index', get_defined_vars());
    }


    public function create()
    {
        if (auth("admins")->check()) {
            $vendors = Vendor::get(['id', 'name'])->pluck('name', 'id')->toArray();
        }

        return view('coupons.create', get_defined_vars());
    }

    public function store(CouponRequest $request)
    {
        $this->repository->store($request->validated());

        return redirect()->route("coupons.index")->with('success', __('Coupon Added successfully.'));
    }

    public function show(Coupon $coupon, Vendor $vendors)
    {
    }

    public function edit(Coupon $coupon)
    {
        if (auth("admins")->check()) {
            $vendors = Vendor::get(['id', 'name'])->pluck('name', 'id')->toArray();
        }

        return view('coupons.edit', get_defined_vars());
    }

    public function update(CouponRequest $request, Coupon $coupon)
    {
        $this->repository->update($request->validated(), $coupon);

        return redirect()->route("coupons.index")->with('success', __('Coupon Updated successfully.'));
    }

    public function destroy(Coupon $coupon)
    {
        $this->repository->destroy($coupon);

        return redirect()->route("coupons.index")->with('success', __('Coupon Deleted successfully.'));
    }

    public function updateStatus(Coupon $coupon)
    {
        $this->repository->updateStatus($coupon);

        return redirect()->route('coupons.index')->with('success', 'Coupon status updated successfully.');
    }
}
