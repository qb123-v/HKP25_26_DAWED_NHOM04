<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        // Lấy thông tin user đang đăng nhập
        $user = Auth::guard('user')->user();
        return view('users.show')->with('user', $user);
    }
    public function edit()
    {
        // Lấy thông tin user đang đăng nhập
        $user = Auth::guard('user')->user();
        return view('users.edit')->with('user', $user);
    }
    public function create()
    {
        return view('auth.register');
    }
    public function store(UserCreateRequest $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        return redirect()->route('user.login')->with('message', 'Tạo thành công tài khoản. Bạn có thể đăng nhập');
    }
}
