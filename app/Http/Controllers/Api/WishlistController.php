<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    use ApiResponseTrait;

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
        ]);

        $user = Auth::user();
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
        $user = Auth::user();
        $vendors = $user->vendors;

        return $this->successResponse($vendors);
    }
}
