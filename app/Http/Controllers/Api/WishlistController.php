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

        $pivot = $user->vendors()->where('vendor_id', $vendor->id)->first();

        if ($pivot) {
            $user->vendors()->detach($vendor);
            $vendor->update(['is_favourite' => false]);
            return $this->errorResponse('تم إزالة هذا البائع من قائمة المفضلات.');
        }

        $user->vendors()->attach($vendor);
        $vendor->update(['is_favourite' => true]);

        return $this->successResponse([
            'vendor' => $vendor,
            'message' => 'تم إضافة البائع إلى قائمة المفضلات بنجاح!',
        ]);
    }

    public function showWishlist()
    {
        $user = Auth::user();
        $vendors = $user->vendors;

        if ($vendors->isEmpty()) {
            return $this->errorResponse('قائمة المفضلات فارغة.');
        }

        return $this->successResponse($vendors);
    }
}
