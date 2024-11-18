<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\VendorRequest;
use App\Models\Role;
use App\Models\Vendor;
use App\Repositories\VendorRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
            new Middleware("permission:show_vendorss", only: ['show']),
            new Middleware("permission:block_vendors", only: ['block', 'unblock']),
            new Middleware("permission:update_vendors", only: ['update', "edit"]),
            new Middleware("permission:forceDelete_vendors", only: ['destroy']),
            new Middleware("permission:delete_vendors", only: ['destroy']),
            new Middleware("permission:readTrashed_vendors", only: ['trash']),
            new Middleware("permission:restore_vendors", only: ['restore']),

        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = $this->repository->index();
        return view('vendors.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('vendors.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(VendorRequest $request)
    {

        $vendor = $this->repository->store($request->validated());
        $role = Role::where('name', 'vendor')->first();
        if ($role) {
            $vendor->roles()->syncWithoutDetaching([$role->id]);
        }




        return redirect()->route('vendors.index')->with('success', __('Vendor created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
