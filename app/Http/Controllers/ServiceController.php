<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Repositories\ServiceRepository;

class ServiceController extends Controller
{
    private $repository;

    public function __construct(ServiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $services = Service::whereNull('parent_id')->get();
        return view('services.index', compact('services'));
    }

    public function create(Request $request)
    {
        $parentId = $request->get('parentId');
        return view('services.create', get_defined_vars());
    }
    public function show(Service $service)
    {

        $sub_service = $service->children;

        return view('services.show', get_defined_vars());
    }

    public function store(ServiceRequest $request)
    {

        $service = $this->repository->store($request->validated());
        return redirect()->route('services.index')->with('success', __('Service created successfully.'));
    }
    public function edit(Service $service)
    {
        return view('services.edit', get_defined_vars());
    }



    public function update(ServiceRequest $request, Service $service)
    {
        $this->repository->update($request->validated(), $service);

        return redirect()->route('services.index');
    }
    public function destroy(Service $service)
    {
        $vendor = Vendor::where('service_id', $service->id)->exists();

        if ($vendor) {
            return redirect()->route('services.index')->with('error', __('Cannot delete service because it is linked to a vendor.'));
        }

        if ($service->children()->exists()) {
            return redirect()->route('services.index')->with('error', __('Cannot delete service with sub-services.'));
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', __('Service deleted successfully.'));
    }
}
