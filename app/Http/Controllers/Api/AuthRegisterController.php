<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Traits\ApiResponseTrait;

class AuthRegisterController extends Controller
{
    use ApiResponseTrait;

    public function register(RegisterRequest $request)
    {
        $checkuser = User::where('email', $request->email)->first();
        if ($checkuser) {
            return $this->errorResponse('Email already Exists');
        }

        $user = User::create($request->validated());

        $code = Str::random(4);

        $user->verification()->create([
            'code' => $code,
            'email' => $request->email
        ]);

        return $this->successResponse(['code' => $code], 'تم التسجيل بنجاح! تحقق من بريدك الإلكتروني.');
    }
}
