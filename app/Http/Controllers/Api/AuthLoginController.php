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
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
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
    // public function checkLoginStatus(Request $request)
    // {

    //     $token = $request->bearerToken();

    //     if ($token) {

    //         $tokenRecord = PersonalAccessToken::where('token', hash('sha256', $token))->first();

    //         if ($tokenRecord) {
    //             $user = $tokenRecord->tokenable;
    //             return response()->json([
    //                 'message' => 'أنت مسجل دخول',
    //                 'user' => $user
    //             ]);
    //         } else {

    //             return response()->json(['message' => 'أنت زائر ولم تقم بتسجيل الدخول.'], 401);
    //         }
    //     } else {
    //         return response()->json(['message' => 'أنت زائر ولم تقم بتسجيل الدخول.'], 401);
    //     }
    // }
}
