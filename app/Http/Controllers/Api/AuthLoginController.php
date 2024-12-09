<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Resources\LoginResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Traits\ApiResponseTrait;

class AuthLoginController extends Controller
{
    use ApiResponseTrait;

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (auth()->attempt($credentials)) {
            $user = Auth::user();

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
}
