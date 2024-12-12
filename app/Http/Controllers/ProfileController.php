<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth ;

class ProfileController extends Controller
{
    public function updateProfile(ProfileRequest $request)
    {
        if (Auth::guard('admins')->check()) {
            $user = Auth::guard('admins')->user();
            $redirectRoute = 'admin.profile';
        } else {
            $user = Auth::guard('vendors')->user();
            $redirectRoute = 'vendors.profile';
        }

        $data = $request->validated();

        if (isset($data["image"])) {
            $user->clearMediaCollection('images');
            $user->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if (!$data["password"]) {
            unset($data["password"]);
        }

        $user->update($data);

        if ($user instanceof \App\Models\Admin) {
            $user->roles()->sync($request->roles);
        }

        return redirect()->route($redirectRoute)->with('success', 'تم تحديث البيانات بنجاح!');
    }
}
