<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdResource;
use App\Models\Ad;

class AdController extends Controller
{
    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ad::with('vendor')->get();

        return AdResource::collection($ads);
    }

    /**
     * عرض إعلان واحد
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ad = Ad::with('vendor')->findOrFail($id);

        return new AdResource($ad);
    }
}
