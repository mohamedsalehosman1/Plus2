<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\ResetPassword;
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
    public function resettoken(ResetPasswordRequest $request)
    {
        $verification = Verification::where('email', $request->email)->first();

        if (!$verification) {
            return $this->errorResponse('Email not found. Please check your email address.', null, 404);
        }

        if ($verification->code !== $request->code) {
            return $this->errorResponse('Invalid verification code. Please check and try again.', null, 400);
        }
        $user = User::where('email', $request->email)->first();

        $resetCode = Str::random(4);


        $user->reset_password_code()->delete();
        $user->reset_password_code()->create([
            'email' => $request->email,
            'code' => $resetCode,
        ]);


        return $this->successResponse(['code' => $resetCode]);
    }
}
