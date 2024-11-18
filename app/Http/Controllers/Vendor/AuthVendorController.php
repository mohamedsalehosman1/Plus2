<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthVendorController extends Controller
{

    //
    public function index()

    {
        return view('vendors.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('vendors')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('vendors.home');
        }

        return back()->withErrors([
            'email' => 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
        ]);
    }


    public function logout()
    {
        Auth::guard('vendors')->logout();
        return redirect('/vendor/login');
    }
}
