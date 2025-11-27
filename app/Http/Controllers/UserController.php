<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
        $user = Auth::guard('user')->user();
        return view('users.edit', compact('user'));
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
    public function update(Request $request)
    {
        $user = Auth::guard('user')->user();

        // Validate input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'gender' => ['nullable', 'in:male,female,other'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'address' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $avatar = $request->file('avatar');
            $avatarName = time() . '_' . $avatar->getClientOriginalName();
            $avatar->move(public_path('uploads/avatars'), $avatarName);
            $validated['avatar'] = 'uploads/avatars/' . $avatarName;
        }

        // Update user information
        $user->update($validated);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công!');
    }
}
