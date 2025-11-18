<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;

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
    
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()
                ->withInput()
                ->withErrors(['email' => 'Không tìm thấy email này trong hệ thống.']);
        }

        // Tạo token
        $token = Str::random(60);

        // Xóa token cũ
        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        // Lưu token mới
        DB::table('password_reset_tokens')->insert([
            'email' => $user->email,
            'token' => Hash::make($token),
            'created_at' => now()
        ]);

        // Gửi email
        $resetUrl = route('user.reset-password', [
            'token' => $token,
            'email' => $user->email
        ]);

        Mail::to($user->email)->send(new ResetPasswordMail($resetUrl));

        return back()->with('message', 'Chúng tôi đã gửi link đặt lại mật khẩu đến email của bạn!');
    }

    public function showResetPasswordForm(Request $request, $token)
    {
        $email = $request->query('email');

        // Kiểm tra token có tồn tại và chưa hết hạn (15 phút)
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if (!$record || !Hash::check($token, $record->token)) {
        return redirect()->route('user.login')
            ->with('error', 'Link đặt lại mật khẩu không hợp lệ.');
    }

    if (now()->diffInMinutes($record->created_at) > 15) {
        return redirect()->route('user.login')
            ->with('error', 'Link đã hết hạn.');
    }

        return view('auth.reset-password', compact('token', 'email'));
    }

    // === MỚI: XỬ LÝ CẬP NHẬT MẬT KHẨU MỚI ===
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$record || !Hash::check($request->token, $record->token)) {
            return back()->withErrors(['email' => 'Link không hợp lệ!']);
        }

        if (now()->diffInMinutes($record->created_at) > 15) {
            return back()->withErrors(['email' => 'Link đã hết hạn!']);
        }

        // Cập nhật mật khẩu
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Xóa token
        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('user.login')
            ->with('message', 'Đặt lại mật khẩu thành công! Vui lòng đăng nhập lại.');
    }
}
