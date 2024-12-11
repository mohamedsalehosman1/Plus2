<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\WishListRequest;
use App\Models\Vendor;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use ApiResponseTrait;

    public function addToWishlist(WishListRequest $request)
    {


        $user =auth()->user();
        $vendor = Vendor::find($request->vendor_id);
        if ($user->vendors()->where('vendor_id', $vendor->id)->first()) {
            $user->vendors()->detach($vendor);
            return $this->errorResponse('Vendor Deleted From Favourite List');
        }
        $user->vendors()->attach($vendor);
        return $this->successResponse([
            'vendor' => $vendor,
            'message' => 'Vendor Added to Favourite List',
        ]);
    }

    public function showWishlist()
    {
        $user =auth()->user();
        $vendors = $user->vendors;
        // $is_favourite = $user->vendors()->where('vendor_id', $vendor->id);



        return $this->successResponse($vendors);
    }
}
