<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{

    public function index()
    {
        return view('login');
    }
    public function login(AdminLoginRequest $request)
    {


        if (Auth::guard('admins')->attempt( $request->validated())) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ]);
    }


    public function logout()
    {
        Auth::guard('admins')->logout();
        return redirect('/login');
    }
}
