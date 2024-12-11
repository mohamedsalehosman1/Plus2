<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\PersonalAccessToken;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $is_favourite = user() ? user()->vendors()->whereVendorId($this->id)->exists() : false;
        return [
            'id' => $this->id,
            'name'        => $this->name,
            'title'       => $this->title,
            'image'       => $this->getFirstMediaUrl('images'),
            'is_favourite' => $is_favourite,
            'coupon'      =>  new CouponResource($this->activeCoupon),
        ];
    }
}
