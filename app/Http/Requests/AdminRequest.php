<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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


    public function StoreRules()
    {
        return RuleFactory::make([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|exists:roles,id',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048', // تحقق من الصورة
        ]);
    }



    public function UpdateRules()
    {
        return RuleFactory::make([

            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'roles' => 'nullable|exists:roles,id',
            'password' => 'nullable|string|min:8|confirmed',  // الكلمة الصحيحة "nullable" بدلاً من "sometimes"
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);
    }
}
