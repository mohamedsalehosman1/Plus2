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
        // dd($this);
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
            'email' => "required|email|unique:admins",
            'password' => 'required|string|min:8',
        ]);
    }
    public function UpdateRules()
    {
        return RuleFactory::make([
            'name' => 'required|string|max:255',
            'email' => "required|email",
            'password' => 'string|min:8|confirmed',
        ]);
    }
}
