<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
 {
   /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'vendor' => $this->vendor->name,
            'image'  => $this->getFirstMediaUrl('images'),

        ];
    }
}
