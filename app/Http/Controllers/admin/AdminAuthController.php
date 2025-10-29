<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check())
        {
            return redirect()->route('admin.dashboard');
        }
        return view('_admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->back()->withInput($request->only('username', 'password'))->withErrors([
            'password' => 'Sai mật khẩu',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
