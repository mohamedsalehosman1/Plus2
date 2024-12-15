<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    use ApiResponseTrait;

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();


        if (!Hash::check($request->current_password, $user->password)) {
            return $this->errorResponse('The current password is incorrect.');
        }

        if ($request->current_password == $request->new_password) {
            return $this->errorResponse('The new password cannot be the same as the current password.');
        }

        $user->password =$request->new_password;
        $user->save();

        return $this->successResponse('Password updated successfully.');
    }
}
