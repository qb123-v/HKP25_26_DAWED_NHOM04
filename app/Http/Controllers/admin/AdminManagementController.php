<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminManagementController extends Controller
{
    // Danh sách Admin
    public function index(Request $request)
    {
        $query = Admin::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('username', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        $admins = $query->latest()->paginate(15);
        $admins->appends(['search' => $request->search]); 

        return view('_admin.admins.index', compact('admins'));
    }

    // Form thêm mới
    public function create()
    {
        return view('_admin.admins.create');
    }

    // Lưu Admin mới
    public function store(Request $request)
    {
        $request->validate([
            'username'     => 'required|string|max:255',
            'email'    => 'required|email|unique:admins,email',
            'password' => 'required|min:6|confirmed',
        ]);

        Admin::create([
            'username'     => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('message', 'Thêm tài khoản Admin thành công!')
            ->with('alert-type', 'success');
    }

    // Form sửa
    public function edit(Admin $admin)
    {
        return view('_admin.admins.edit', compact('admin'));
    }

    // Cập nhật Admin
    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'username'  => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only('username', 'email');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')
            ->with('message', 'Cập nhật tài khoản Admin thành công!')
            ->with('alert-type', 'success');
    }

    // Xóa Admin
    public function destroy(Admin $admin)
    {
        // Không cho xóa chính mình
        if ($admin->id === auth('admin')->id()) {
            return back()->with('message', 'Không thể tự xóa tài khoản đang đăng nhập!')
                ->with('alert-type', 'danger');
        }

        $admin->delete();

        return back()->with('message', 'Xóa tài khoản Admin thành công!')
            ->with('alert-type', 'success');
    }
}
