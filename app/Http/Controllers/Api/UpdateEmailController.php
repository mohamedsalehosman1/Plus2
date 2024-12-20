<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateEmailRequest;
use App\Http\Requests\Api\VerfiyRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Str;
use App\Models\Verification;


class UpdateEmailController extends Controller
{
    use ApiResponseTrait;

    public function sendEmail(UpdateEmailRequest $request)
    {
        $user = Auth::user();
        $code = Str::random(4);

        $user->verification()->delete();

        $user->verification()->create([
            'code' => $code,
            'email' => $request->email,
        ]);

        return $this->successResponse(['code' => $code], 'تم إرسال كود التحقق الجديد إلى بريدك الإلكتروني.');
    }
    public function updateEmail(VerfiyRequest $request)
    {
        $user = Auth::user();

        $verification = Verification::where('email', $request->email)->first();

        if ($verification->code !== $request->code) {
            return $this->errorResponse('Invalid verification code. Please check and try again.');
        }

        $user->email = $request->email;
        $user->email_verified_at = now();
        $user->save();

        $verification->delete();

        return $this->successResponse('Email successfully verified.');
    }
}
