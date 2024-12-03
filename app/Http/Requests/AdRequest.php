<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
        // تحديد القواعد بناءً على ما إذا كانت العملية هي 'post' أو 'put'
        if (request()->ismethod('post')) {
            return $this->StoreRules();
        } else {
            return $this->UpdateRules();
        }
    }

    /**
     * القواعد الخاصة بالتحقق عند إضافة إعلان جديد
     */
    public function StoreRules(): array
    {
        return [
            'name' => 'required|string|max:255', // التحقق من وجود الاسم، وأنه نصي، ولا يتجاوز 255 حرفًا
            'description' => 'required|string|max:1000', // التحقق من وجود الوصف، وأنه نصي، ولا يتجاوز 1000 حرف
            'vendor_id' => 'required|exists:vendors,id', // التحقق من وجود "vendor_id" وربطه بالبائعين في قاعدة البيانات
        ];
    }

    /**
     * القواعد الخاصة بالتحقق عند تحديث الإعلان
     */
    public function UpdateRules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255', // إذا تم إرسال الاسم، يجب التحقق منه
            'description' => 'sometimes|required|string|max:1000', // إذا تم إرسال الوصف، يجب التحقق منه
            'vendor_id' => 'sometimes|required|exists:vendors,id', // إذا تم إرسال "vendor_id" يجب التحقق من وجوده في جدول البائعين
        ];
    }
}
