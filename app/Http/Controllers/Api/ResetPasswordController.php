<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ResetPasswordRequest;
use App\Http\Requests\Api\ResetTokenRequest;
use App\Http\Requests\Api\UpdatePasswordRequest;
use App\Models\ResetPassword;
use App\Models\ResetToken;
use App\Models\User;
use App\Models\Verification;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller

{
    use ApiResponseTrait;
    public function requestResetCode(ResetPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        $resetCode = Str::random(4);


        $user->reset_password_code()->delete();
        $user->reset_password_code()->create([
            'email' => $request->email,
            'code' => $resetCode,
        ]);


        return $this->successResponse(['code' => $resetCode]);
    }

    public function resettoken(ResetTokenRequest $request)
    {
        $resetPassword = ResetPassword::where('email', $request->email)->first();

        if ($resetPassword->code != $request->code) {
            return $this->errorResponse('the ocde is wrong');
        }

        $user = $resetPassword->resetable;

        $user->reset_password_code()->delete();
        $user->reset_password_token()->delete();

        $token = Str::random(length: 20);

        $user->reset_password_token()->create([
            'email' => $request->email,
            'token' => $token,
        ]);

        return $this->successResponse(['token' => $token]);
    }
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = User::whereHas('reset_password_token', function ($query) use ($request) {
            $query->where('token', $request->token);
        })->first();

        if (!$user) {
            return $this->errorResponse('some error has habben ,please try again .');
        }

        $user->password = $request->password;
        $user->save();

        $user->reset_password_token()->delete();
        $user->reset_password_code()->delete();

        return $this->successResponse('Password updated successfully.');
    }
}
