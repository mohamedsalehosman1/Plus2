<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use App\Http\Requests\ServiceRequest;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
public function index(){
    $services = Service::with('translations')->get();

        return ServiceResource::collection($services);
}
public function show($id){
    $service = Service::with('translations')->findOrFail($id);

    return new ServiceResource($service);
}
public function store(ServiceRequest $request)
{
    $data =$request->validated();
    $service = Service::create($data);

    // إرجاع الاستجابة مع الخدمة الجديدة
    return new ServiceResource($service);
}}
