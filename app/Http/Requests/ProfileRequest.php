<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $adminId = auth()->guard('admins')->id();

        return [
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:admins,email,{$adminId}",
            'password' => 'nullable|string|min:8|confirmed',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
