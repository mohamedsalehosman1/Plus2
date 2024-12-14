<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\VendorResource;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class ServiceController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $service = Service::get();

        return ServiceResource::collection($service);
    }
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }
}
