<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(UserLoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials))
        {
            // Nếu đăng nhập thành công
            $request->session()->regenerate();
            return redirect()->intended(route('user.dashboard'));
        }
        // Đăng nhập không thành công
        $request->session()->regenerateToken();
        return redirect()->back()
            ->withInput($request->only('email', 'password'))
            ->withErrors([
                'password' => 'Sai mật khẩu',
            ]);
    }
    public function logout(Request $request)
    {
        // Nếu chưa login, redirect về trang login (tránh invalidate khi không cần)
        if (!Auth::guard('user')->check())
        {
            $request->session()->regenerateToken();
            return redirect()->route('user.login');
        }
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.login');
    }

}
