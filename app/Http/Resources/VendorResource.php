<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     *
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $imageUrl = $this->getFirstMediaUrl('images'); // 'images' هو اسم مجموعة الوسائط في Media Library

        return [
            'name'   => $this->name,
            'title'  => $this->title,
            'image'  => $imageUrl,  // عرض الرابط الكامل للصورة
        ];
    }


}
