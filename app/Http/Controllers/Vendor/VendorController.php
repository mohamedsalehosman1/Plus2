<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\VendorRequest;
use App\Http\Resources\Tests;
use App\Models\Role;
use App\Models\Service;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller implements HasMiddleware
{
    private $repository;

    public function __construct(VendorRepository $repository)
    {
        $this->repository = $repository;
    }
    public static function middleware()
    {
        return [
            new Middleware("permission:read_vendors", only: ['index', "trash"]),
            new Middleware("permission:create_vendors", only: ['create', 'store']),
            new Middleware("permission:show_vendors", only: ['show']),
            new Middleware("permission:block_vendors", only: ['block', 'unblock']),
            new Middleware("permission:update_vendors", only: ['update', "edit"]),
            new Middleware("permission:forceDelete_vendors", only: ['destroy']),
            new Middleware("permission:delete_vendors", only: ['destroy']),
            new Middleware("permission:readTrashed_vendors", only: ['trash']),
            new Middleware("permission:restore_vendors", only: ['restore']),

        ];
    }

    public function index()
    {
        $services = Service::with('children')->whereNull('parent_id')->get();

        $vendors = $this->repository->index();
        return view('vendors.index', get_defined_vars());
    }


    public function create()
    {
        $roles = Role::all();

        $services = Service::with('children')->whereNull('parent_id')->get();

        return view('vendors.create', compact('roles', 'services'));
    }


    public function store(VendorRequest $request)
    {
        $this->repository->store($request->validated());
        return redirect()->route('vendors.index')->with('success', __('Vendor created successfully.'));
    }

    public function show(Vendor $vendor)
    {
        return view('vendors.show', get_defined_vars());
    }

    public function edit(Vendor $vendor)
    {
        $services = Service::with('children')->whereNull('parent_id')->get();

        return view('vendors.update', get_defined_vars());
    }

    public function update(VendorRequest $request, Vendor $vendor)
    {

        $this->repository->update($request->validated(), $vendor);

        return redirect()->route('vendors.index')->with('success', __('Vendor updated successfully.'));
    }



    public function destroy(Vendor $vendor)
    {
        if($this->canDelete($vendor)){
            $this->repository->destroy($vendor);
            return redirect()->route('vendors.index')->with('success', __('Vendor soft deleted successfully.'));
        }

        return redirect()->route('vendors.index')->with('error', __('Vendor cant delele due relation to other data'));
    }


    private function canDelete($vendor)
    {
        $adsCount =  $vendor->ads()->exists();
        $couponsCount =  $vendor->coupons()->exists();

        return !$adsCount && !$couponsCount == false;
    }

    public function trash()
    {
        $vendors = $this->repository->trash();
        return view('vendors.trash', get_defined_vars());
    }

    public function restore($id)
    {
        $vendor = $this->repository->find($id, true);
        $this->repository->restore($vendor);

        return redirect()->route('vendors.trash')->with('success', __('Vendor restored successfully.'));
    }

    public function forcedelete(Vendor $vendor)
    {
        $vendor->forceDelete();
        return redirect()->route('vendors.index')->with('success', trans('vendors.vendor_deleted_permanently'));
    }
    public function showProfile()
    {
        $vendor = Auth::guard('vendors')->user();
        return view('profile', compact('vendor'));
    }
}
