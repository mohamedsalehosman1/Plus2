<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\LoginNotification;
use App\Traits\ApiResponseTrait;

class AuthLoginController extends Controller
{
    use ApiResponseTrait;

    public function login(loginRequest $request)
    {
        $credentials = $request->validated();
        if (auth()->attempt($credentials)) {
            $user = Auth::user();
            $user->tokens()->delete();
            $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;
            $success['name'] = $user->name;
            $success['success'] = true;
            $user->notify(new LoginNotification);
            return $this->successResponse($success, 'Login successful.');
        } else {
            return $this->errorResponse('Error at email or password', null, 401);
        }
    }
}
