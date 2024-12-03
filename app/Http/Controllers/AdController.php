<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdRequest;
use App\Models\Ad;
use App\Models\Vendor;
use App\Repositories\AdRepository;
use Illuminate\Http\Request;

class AdController extends Controller
{
    private $repository;

    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $vendor_id = $request->get('vendor_id', auth('vendors')->check() ? auth('vendors')->user()->id : null);
        $ads = $this->repository->index();
        return view('Ads.index', compact('ads'));
    }

    public function create()
    {
        $vendors = auth("admins")->check() ? Vendor::pluck('name', 'id')->toArray() : [];
        return view('Ads.create', compact('vendors'));
    }

    public function store(AdRequest $request)
    {
        $data = $request->validated();
        $ad = $this->repository->store($data);

        if ($request->hasFile('image')) {
            $ad->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (auth('vendors')->check()) {
            $ad->vendor_id = auth('vendors')->user()->id;
            $ad->save();
        }

        return redirect()->route('ads.index')->with('success', __('Ad Added successfully.'));
    }

    public function edit(Ad $Ad)
    {
        $vendors = auth("admins")->check() ? Vendor::pluck('name', 'id')->toArray() : [];
        return view('Ads.edit', compact('Ad', 'vendors'));
    }

    public function update(AdRequest $request, Ad $Ad)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $Ad->clearMediaCollection('images');
            $Ad->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (auth('vendors')->check()) {
            $data['vendor_id'] = auth('vendors')->user()->id;
        }

        $this->repository->update($data, $Ad);
        return redirect()->route("Ads.index")->with('success', __('Ad Updated successfully.'));
    }

    public function destroy(Ad $Ad)
    {
        $Ad->clearMediaCollection('images');
        $this->repository->destroy($Ad);
        return redirect()->route("ads.index")->with('success', __('Ad Deleted successfully.'));
    }

    public function updateStatus(Ad $Ad)
    {
        $this->repository->updateStatus($Ad);
        return redirect()->route('ads.index')->with('success', 'Ad status updated successfully.');
    }
}
