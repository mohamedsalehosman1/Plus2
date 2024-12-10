<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Models\Vendor;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ShowVendorController extends Controller
{
    use ApiResponseTrait;

    public function index(Request $request)
    {
        $vendors = Vendor::byServiceId($request->service_id)->get();
        if ($vendors->isEmpty()) {
            return $this->errorResponse('No vendors found.');
        }
        return VendorResource::collection($vendors);
    }

    public function show($id)
    {
        $vendor = Vendor::find($id);

        if (!$vendor) {
            return $this->errorResponse('Vendor not found.');
        }

        return new VendorResource($vendor);
    }
}
