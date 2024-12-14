<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::with('vendor')->get();

        return AdResource::collection($ads);
    }


    public function show(Ad $ad)
    {

        return new AdResource($ad);
    }
}
