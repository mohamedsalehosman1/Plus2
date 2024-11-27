<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;

class AuthRegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $checkuser = User::where('email', $request->email)->first();
        if ($checkuser) {
            return response()->json([
                'message' => 'Email already Exists'
            ], 400);
        }

        $user = User::create($request->validated());

        $Code = Str::random(length: 4);

        $user->verification()->create([
            'code' => $Code
        ]);


        // Mail::to($user->email)->send(new VerifyEmail($user, $Code));

        return response()->json([
            'message' => 'تم التسجيل بنجاح! تحقق من بريدك الإلكتروني.',
            'code' => $Code

        ], 201);
    }
}
