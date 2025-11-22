<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterManagementController extends Controller
{
    public function index()
    {
        return view('_admin.footer.index');
    }

    public function update(Request $request)
    {
        // Tạm thời chỉ demo
        return back()->with('success', 'Đã lưu thay đổi thành công!');
    }
}
