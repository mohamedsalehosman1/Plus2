<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\VendorRequest;
use App\Http\Resources\Tests;
use App\Models\Role;
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
        $vendors = $this->repository->index();
        $data =Tests::collection($vendors);
        return $data;
        return view('vendors.index', get_defined_vars());
    }


    public function create()
    {
        $roles = Role::all();
        return view('vendors.create', get_defined_vars());
    }
    public function store(VendorRequest $request)
    {

        $vendor = $this->repository->store($request->validated());        $vendor->addMediaFromRequest('image')->toMediaCollection('images');

        $role = Role::where('name', 'vendor')->first();
        if ($role) {
            $vendor->roles()->syncWithoutDetaching([$role->id]);
        }
        return redirect()->route('vendors.index')->with('success', __('Vendor created successfully.'));
    }
    public function show(Vendor $vendor)
    {
        return view('vendors.show', get_defined_vars());
    }

    public function edit(Vendor $vendor)
    {

        return view('vendors.update', get_defined_vars());
    }

    public function update(VendorRequest $request, $id)
    {
        $vendor = $this->repository->find($id);

        if ($request->has('password') && $request->password) {
            $vendor->password = $request->password;
        } else {
            $request->request->remove('password');
        }

        $vendor->update($request->except('password'));

        if ($request->hasFile('image')) {
            $vendor->clearMediaCollection('images');
            $vendor->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('vendors.index')->with('success', __('Vendor updated successfully.'));
    }



    public function destroy(Vendor $vendor)
    {
        $this->repository->destroy($vendor);
        return redirect()->route('vendors.index')->with('success', __('Vendor soft deleted successfully.'));
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

    public function forcedelete($id)
    {
        $vendor = Vendor::withTrashed()->findOrFail($id);
        $vendor->forceDelete();
        return redirect()->route('vendors.index')->with('success', trans('vendors.vendor_deleted_permanently'));
    }
    public function showProfile()
    {
        $vendor = Auth::guard('vendors')->user();
        return view('profile', compact('vendor'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        $vendor = Auth::guard('vendors')->user();
        $data = $request->validated();
        if (isset($data["image"])) {
            $vendor->clearMediaCollection('images');
            $vendor->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (!$data["password"]) {
            unset($data["password"]);
        }

        $vendor->update($data);
        return redirect()->route('vendors.profile')->with('success', 'تم تحديث البيانات بنجاح!');
    }
}
