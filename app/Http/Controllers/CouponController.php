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
<<<<<<< HEAD

    public function index(Request $request)
    {
        $vendor_id = $request->get('vendor_id', auth('vendors')->check() ? auth('vendors')->user()->id : null);

        $coupons = $this->repository->index($vendor_id );
=======
    public function index()
    {

        $coupons = $this->repository->index();
>>>>>>> 9e2279537b289d0f00b42cf0fbacd6ada7f13c9b

        return view('coupons.index', get_defined_vars());
    }


    public function create()
    {
        if (auth("admins")->check()) {
            $vendors = Vendor::get(['id', 'name'])->pluck('name', 'id')->toArray();
<<<<<<< HEAD
        } else {
            $vendors = [];
=======
        } else{
            $vendors=[];
>>>>>>> 9e2279537b289d0f00b42cf0fbacd6ada7f13c9b
        }

        return view('coupons.create', compact('vendors'));
    }

    public function store(CouponRequest $request)
    {
<<<<<<< HEAD
        // dd($request);
=======
>>>>>>> 9e2279537b289d0f00b42cf0fbacd6ada7f13c9b
        $this->repository->store($request->validated());

        return redirect()->route("coupons.index")->with('success', __('Coupon Added successfully.'));
    }

<<<<<<< HEAD
=======
    public function show(Coupon $coupon, Vendor $vendors)
    {
        // Logic for showing coupon details
    }

>>>>>>> 9e2279537b289d0f00b42cf0fbacd6ada7f13c9b
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
