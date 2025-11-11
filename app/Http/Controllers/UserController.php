<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

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
}
