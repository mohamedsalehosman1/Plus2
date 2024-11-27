<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthLoginController extends Controller
{

public function login(loginRequest $request){
$credentials =$request->validated();
if(auth()->attempt($credentials)){
    $user =Auth::user();
    $user->tokens()->delete();
    $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;
    $success['name'] = $user->name;
    return response()->json($success, 200);

}
else{
    return response()->json(['error'=>'unauthorized'],401);

}
}
}
