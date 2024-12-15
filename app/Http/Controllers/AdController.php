<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Models\Vendor;
use App\Repositories\AdRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AdController extends Controller implements HasMiddleware
{
    private $repository;

    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }
    public static function middleware()
    {
        return [
            new Middleware("permission:read_ads", only: ['index']),
            new Middleware("permission:create_ads", only: ['create', 'store']),
            new Middleware("permission:show_ads", only: ['show']),
            new Middleware("permission:update_ads", only: ['update', 'edit']),
            new Middleware("permission:delete_ads", only: ['destroy']),
        ];
    }
    public function index(Request $request)
    {
        $ads = $this->repository->index();
        return view('ads.index', get_defined_vars());
    }

    public function create()
    {
        $vendors = auth("admins")->check() ? Vendor::pluck('name', 'id')->toArray() : [];

        return view('ads.create', get_defined_vars());
    }

    public function store(AdRequest $request)
    {
        $ad = $this->repository->store($request->validated());

        return redirect()->route('ads.index')->with('success', __('Ad Added successfully.'));
    }

    public function edit(Ad $ad)
    {
        $vendors = auth("admins")->check() ? Vendor::pluck('name', 'id')->toArray() : [];

        return view('ads.edit', get_defined_vars());
    }

    public function update(AdRequest $request, Ad $ad)
    {

        if (auth('vendors')->check()) {
            $data['vendor_id'] = auth('vendors')->user()->id;
        }

        $this->repository->update($request->validated(), $ad);
        return redirect()->route("ads.index")->with('success', __('Ad Updated successfully.'));
    }

    public function destroy(Ad $ad)
    {
        $this->repository->destroy($ad);
        return redirect()->route("ads.index")->with('success', __('Ad Deleted successfully.'));
    }

    public function updateStatus(Ad $ad)
    {
        $this->repository->updateStatus($ad);
        return redirect()->route('ads.index')->with('success', 'Ad status updated successfully.');
    }
}
