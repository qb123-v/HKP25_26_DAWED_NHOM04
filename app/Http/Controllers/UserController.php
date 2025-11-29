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

        // Enhanced validation with regex
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[\pL\s]+$/u'],
            'email' => ['required', 'email', 'max:255', 'regex:/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20', 'regex:/^(0|\+84)[0-9]{9}$/'],
            'gender' => ['nullable', 'in:male,female,other'],
            'birthday' => ['nullable', 'date', 'before:today', 'after:1900-01-01'],
            'address' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,jpg,png,gif', 'max:2048', 'dimensions:min_width=100,min_height=100'],
        ], [
            'name.required' => 'Tên là bắt buộc.',
            'name.min' => 'Tên phải có ít nhất 2 ký tự.',
            'name.regex' => 'Tên chỉ được chứa chữ cái và khoảng trắng.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã được sử dụng.',
            'phone.regex' => 'Số điện thoại không hợp lệ (VD: 0912345678).',
            'birthday.before' => 'Ngày sinh phải trước ngày hôm nay.',
            'avatar.image' => 'File phải là ảnh.',
            'avatar.mimes' => 'Ảnh phải có định dạng: jpeg, jpg, png, gif.',
            'avatar.max' => 'Kích thước ảnh không được vượt quá 2MB.',
            'avatar.dimensions' => 'Kích thước ảnh tối thiểu 100x100 pixels.',
        ]);

        // Handle avatar upload with better error handling
        if ($request->hasFile('avatar')) {
            try {
                // Validate is actually an image
                $avatar = $request->file('avatar');
                
                if (!@getimagesize($avatar->getRealPath())) {
                    return back()->withErrors(['avatar' => 'File không phải là ảnh hợp lệ.'])->withInput();
                }

                // Delete old avatar if exists
                if ($user->avatar && file_exists(public_path($user->avatar))) {
                    @unlink(public_path($user->avatar));
                }

                // Create directory if not exists
                $uploadPath = public_path('uploads/avatars');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $avatarName = time() . '_' . uniqid() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move($uploadPath, $avatarName);
                $validated['avatar'] = 'uploads/avatars/' . $avatarName;
            } catch (\Exception $e) {
                return back()->withErrors(['avatar' => 'Lỗi khi tải ảnh lên: ' . $e->getMessage()])->withInput();
            }
        }

        // Update user information
        $user->update($validated);

        return redirect()->route('user.edit')->with('success', 'Cập nhật thông tin thành công!');
    }
}
