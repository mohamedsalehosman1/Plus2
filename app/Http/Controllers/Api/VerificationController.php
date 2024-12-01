<?php

namespace App\Http\Controllers\Api;

use App\Models\Verification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerfiyRequest;
use Illuminate\Support\Str;
use App\Traits\ApiResponseTrait;

class VerificationController extends Controller
{
    use ApiResponseTrait;

    public function verifyEmail(VerfiyRequest $request)
    {
        $verification = Verification::where('email', $request->email)->first();

        if (!$verification) {
            return $this->errorResponse('Email not found. Please check your email address.', null, 404);
        }

        if ($verification->code !== $request->code) {
            return $this->errorResponse('Invalid verification code. Please check and try again.', null, 400);
        }

        $user = $verification->verifiable;
        $user->email_verified_at = now();
        $user->save();

        $verification->delete();

        return $this->successResponse(null, 'Email successfully verified.');
    }

    public function resendCode(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $user->verification()->delete();

        $code = Str::random(4);

        $user->verification()->create([
            'code' => $code,
            'email' => $request->email,
        ]);

        return $this->successResponse(['code' => $code], 'تم إرسال كود التحقق الجديد إلى بريدك الإلكتروني.');
    }
}
