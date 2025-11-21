<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        // Sắp xếp
        if ($request->filled('sort') && in_array($request->sort, ['name', 'email', 'created_at'])) {
            $direction = $request->direction === 'asc' ? 'asc' : 'desc';
            $query->orderBy($request->sort, $direction);
        } else {
            $query->latest(); // mặc định mới nhất trước
        }

        $users = $query->latest()->paginate(15);
        $users->appends($request->all());

        return view('_admin.users.index', compact('users'));
    }

    public function edit(User $user)
    {
        return view('_admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = $request->only(['name', 'email']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('message', 'Cập nhật người dùng thành công!')
            ->with('alert-type', 'success');
    }

    public function destroy(User $user)
    {
        // Không cho xóa chính mình (nếu admin dùng bảng users để login)
        if ($user->id === auth()->id() || $user->id === auth('admin')->id()) {
            return back()->with('message', 'Không thể xóa tài khoản đang đăng nhập!')
                ->with('alert-type', 'danger');
        }

        $user->delete();

        return back()->with('message', 'Xóa người dùng thành công!')
            ->with('alert-type', 'success');
    }
}
