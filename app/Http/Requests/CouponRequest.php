<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */



    public function rules(): array
    {
        if (request()->ismethod('post')) {
            return $this->StoreRules();
        } else {
            return $this->UpdateRules();
        }
    }
    public function StoreRules(): array
    {
        return [
            'code' => 'required|unique:coupons,code|max:255',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'max_discount' => 'required|numeric|min:0',
            'start_at' => 'required|date|after_or_equal:today',
            'end_at' => 'required|date|after:start_at',
            'max_use' => 'required|integer|min:1',
            'max_use_per_user' => 'required|integer|min:1|lt:max_use',
            'vendor_id' => 'required|exists:vendors,id',
        ];
    }
    public function UpdateRules(): array
    {
        return [
            'code' => 'nullable|unique:coupons,code|max:255',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'max_discount' => 'required|numeric|min:0',
            'start_at' => 'nullable|date|after_or_equal:today',
            'end_at' => 'required|date|after:start_at',
            'max_use' => 'required|integer|min:1',
            'max_use_per_user' => 'required|integer|min:1|lt:max_use',
            'vendor_id' => 'nullable|exists:vendors,id',
        ];
    }
}
