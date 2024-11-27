<?php

namespace App\Http\Controllers\Api;

use App\Models\Verification;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string',
        ]);

        $verification = Verification::where('code', $request->code)
            ->where('email', $request->email)
            ->first();

        if ($verification && !$verification->is_verified) {
            $verification->is_verified = true;
            $verification->save();



            return response()->json([
                'message' => 'تم التحقق من بريدك الإلكتروني بنجاح!',
            ]);
        }

        if (!$verification) {
            $newCode = Str::random(6);

            $user = User::where('email', $request->email)->first();
            if ($user) {
                $newVerification = Verification::create([
                    'code' => $newCode,

                ]);

                return response()->json([
                    'message' => 'الكود غير صالح أو انتهت صلاحيته. تم إرسال كود جديد إلى بريدك الإلكتروني.',
                ]);
            }

            return response()->json([
                'message' => 'البريد الإلكتروني غير مسجل.',
            ], 400);
        }

        return response()->json([
            'message' => 'تم التحقق من بريدك الإلكتروني بالفعل.',
        ]);
    }
}
