<?php

namespace App\Repositories;

use App\Models\Ad;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Collection;

class AdRepository implements CrudsInterface
{
    public function index($vendor_id = null)
    {
            return Ad::when(auth('vendors')->user(),function($q){
                $q->where('vendor_id', auth('vendors')->user()->id);
            })->get();

    }

    public function store($data)
    {
        // إنشاء الإعلان الجديد باستخدام البيانات المدخلة
        return Ad::create($data);
    }

    public function update($data, $model)
    {
        // تحديث الإعلان بناءً على البيانات المدخلة
        return $model->update($data);
    }

    public function destroy($model)
    {
        // حذف الإعلان
        return $model->delete();
    }

    public function trash()
    {
        // جلب الإعلانات المحذوفة
        return Ad::onlyTrashed()->paginate(request('perPage'));
    }

    public function find($id, $withTrashed = false)
    {
        // جلب الإعلان بناءً على الـ ID، مع إمكانية تضمين الإعلانات المحذوفة إذا كان معلم "withTrashed" مفعلًا
        return Ad::when($withTrashed, function ($q) {
            return $q->withTrashed();
        })->findOrFail($id);
    }

    public function restore($model)
    {
        // استعادة الإعلان المحذوف
        return $model->restore();
    }

    public function updateStatus(Ad $Ad)
    {
        // تحديث حالة الإعلان بين التنشيط والتعطيل
        if (!$Ad->status) {
            // إذا كان الإعلان غير نشط، يتم تعطيل جميع الإعلانات الأخرى للبائع نفسه
            Ad::where('vendor_id', $Ad->vendor_id)
                ->update(['status' => false]);
        }

        // تغيير حالة الإعلان الحالية بين التنشيط والتعطيل
        $Ad->status = !$Ad->status;
        return $Ad->save();
    }
}

