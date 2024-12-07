<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
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
        $services = Service::with('children')->whereNull('parent_id')->get();
        return view('services.index', compact('services'));
    }

    public function create(Request $request)
    {
        $parentId = $request->get('parentId');
        return view('services.create', get_defined_vars());
    }
    public function show($id)
    {
        $service = Service::with('children')->findOrFail($id);

        $sub_service = $service->children;
        return view('services.show', get_defined_vars());
    }

    public function store(ServiceRequest $request)
    {
        $data = $request->validated();
        if ($request->has('parent_id')) {
            $data['parent_id'] = $request->parent_id;
        }
        $service = $this->repository->store($data);
        $service->addMediaFromRequest('image')->toMediaCollection('images');


        return redirect()->route('services.index')->with('success', __('Service created successfully.'));
    }
    public function edit($id)
    {
        $service = Service::with('translations')->findOrFail($id);
        $name_en = $service->translations()->where('locale', 'en')->first()->name ?? '';
        $name_ar = $service->translations()->where('locale', 'ar')->first()->name ?? '';
        return view('services.edit', get_defined_vars());
    }



    public function update(ServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);

        $data = $request->validated();

        $service->translations()->updateOrCreate(
            ['locale' => 'en'],
            ['name' => $data['name_en']]
        );

        $service->translations()->updateOrCreate(
            ['locale' => 'ar'],
            ['name' => $data['name_ar']]
        );

        if ($request->hasFile('image')) {
            $service->clearMediaCollection('images');
            $service->addMediaFromRequest('image')->toMediaCollection('images');
        }
        $service = $this->repository->update($data, $service);

        return redirect()->route('services.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services.index');
    }
}
