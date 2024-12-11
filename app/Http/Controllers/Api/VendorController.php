<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VendorResource;
use App\Http\Resources\VendorBreifResource;
use App\Models\Vendor;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $vendors = Vendor::whereHas('activeCoupon')->byServiceId()->get();
        return VendorBreifResource::collection($vendors);
    }

    public function show(Vendor $vendor)
    {
        return $this->successResponse(new VendorResource($vendor));
    }

}
