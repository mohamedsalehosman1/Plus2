<?php

namespace App\Http\Controllers\Api;

use App\Models\Verification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\VerfiyRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;



class VerificationController extends Controller
{
    public function verifyEmail(VerfiyRequest $request)
    {
        $verification = Verification::where('email', $request->email)
            ->first();

        if (!$verification) {
            return response()->json([
                'message' => 'Email not found. Please check your email address.',
            ], 404);
        }

        if ($verification->code !== $request->code) {
            return response()->json([
                'message' => 'Invalid verification code. Please check and try again.',
            ], 400);
        }

        $user = $verification->verifiable;
        $user->email_verified_at = now();
        $user->save();

        $verification->delete();


        return response()->json([
            'message' => 'Email successfully verified.',
        ]);
    }


    public function resendcode(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->verification()->delete();
            $code = Str::random(4);


            $user->verification()->create([
                'code' => $code,
                'email' => $request->email,
            ]);

            return response()->json([
                'message' => 'تم إرسال كود التحقق الجديد إلى بريدك الإلكتروني.',
                'code' => $code,
            ]);
        }

        return response()->json([
            'message' => 'المستخدم غير موجود بالبريد الإلكتروني المدخل.',
        ], 404);
    }
}
