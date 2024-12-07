<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\App;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {

        $name_en = $this->translations()->where('locale', 'en')->first()->name ?? '';
        $name_ar = $this->translations()->where('locale', 'ar')->first()->name ?? '';

        return [
            'id' => $this->id,
            'name_en' => $name_en,
            'name_ar' => $name_ar,

            'parent_id' => $this->parent_id,
        ];
    }
}
