<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\LoginNotification;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Str;

class AuthLoginController extends Controller
{
    use ApiResponseTrait;
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();
        if (auth()->attempt($credentials)) {
            $user = Auth::user();

            if (!$user->hasVerifiedEmail()) {
                return $this->errorResponse('Please verify your email address.'  );
            }

            $token = $user->createToken(request()->userAgent())->plainTextToken;
            return $this->successResponse($token, 'Login successful.');
        } else {
            return $this->errorResponse('Error with email or password.');
        }
    }
}
