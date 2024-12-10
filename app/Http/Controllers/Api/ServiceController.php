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

public function index(){
    $service = Service::with('translations')->get();

        return ServiceResource::collection($service);
}
public function show($id){
    $service = Service::with('translations')->findOrFail($id);
    return new ServiceResource($service);
}
// public function showvendor($id){
//     $service = Service::find($id);
//     $vendor = Vendor::where('service_id', $service->id)->get();

//  return new VendorResource($vendor);
// }
public function store(ServiceRequest $request)
{
    $data =$request->validated();
    $service = Service::create($data);

    // إرجاع الاستجابة مع الخدمة الجديدة
    return new ServiceResource($service);
}}
