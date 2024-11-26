<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Http\Requests\Api\RegisterRequest;

class AuthRegisterController extends Controller
{

    public function register(RegisterRequest $request)
    {
        $newuser = $request->validated();
        $user = User::create($newuser);
        $sucess['token'] = $user->createToken('user', ['app:all'])->plainTextToken;
        return response()->json('sucess', 200);
    }
}
