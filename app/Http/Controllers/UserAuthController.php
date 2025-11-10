<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('user')->check())
        {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
        }
        return redirect()->back()->withInput($request->only('email', 'password'))->withErrors([
            'password' => 'Sai mật khẩu',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }
}
