<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ResetTokenRequest;
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

        $user = User::where('email', $request->email)->first();



        $user->reset_password_token()->delete();
        $data['token'] = $user->createToken(request()->userAgent())->plainTextToken;


        return $this->successResponse($data);
    }
}
