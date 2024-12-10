<?php

namespace App\Http\Resources;

use App\Models\Service;
use App\Models\Vendor;
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
        // $service = Service::find($this->id);
        // $vendor = Vendor::where('service_id', $service->id)->first();
        return [
            'id' => $this->id,
            'name_en' => $name_en,
            'name_ar' => $name_ar,
            'parent_id' => $this->parent_id,
            'image'       => $this->getFirstMediaUrl('images'),

        ];
    }
}
