<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Http\Request;

class AuthLoginController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request)
    {


        if (Auth::attempt(  $request->validated())) {
            $user = auth()->user();

            if (!$user->hasVerifiedEmail()) {
                return $this->errorResponse('Please verify your email address.');
            }

            $token = $user->createToken(request()->userAgent())->plainTextToken;

            $user->token = $token;

            return new LoginResource($user);
        } else {
            return $this->errorResponse('Error with email or password.');
        }
    }
    public function checkLoginStatus()
    {
        $user = user(); // استدعاء الدالة التي كتبتها لفحص حالة التوكن

        if ($user) {
            // إذا كان المستخدم مسجل الدخول
            return response()->json([
                'status' => 'logged_in',
                'user' => $user // إرجاع بيانات المستخدم المسجل
            ], 200);
        } else {
            // إذا لم يكن المستخدم مسجل الدخول
            return response()->json([
                'status' => 'guest' // مستخدم زائر لم يسجل الدخول
            ], 200);
        }
    }
}
