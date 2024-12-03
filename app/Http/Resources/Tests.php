<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Tests extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     *
     * "id": 1,
            "code": "123",
            "discount_percent": "10.00",
            "max_discount": "50.00",
            "start_at": "2024-11-26T00:00:00.000000Z",
            "end_at": "2024-11-29T00:00:00.000000Z",
            "max_use": 15,
            "max_use_per_user": 1,
            "is_active": 0,
            "vendor_id": 2,
            "created_at": "2024-11-26T09:01:07.000000Z",
            "updated_at": "2024-11-26T09:02:07.000000Z"
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
        ];
    }


}
