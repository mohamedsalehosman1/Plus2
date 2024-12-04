<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

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
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'vendor_id' => 'required|exists:vendors,id',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function UpdateRules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
            'vendor_id' => 'sometimes|required|exists:vendors,id',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
