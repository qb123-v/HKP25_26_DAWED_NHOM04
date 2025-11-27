<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Footer;


class FooterManagementController extends Controller
{
    public function index()
    {
        // Lấy tất cả footer key/value
        $footers = Footer::all()->pluck('value', 'key')->toArray();
        return view('_admin.footer.index', compact('footers'));
    }

    public function update(Request $request)
    {

        $request->validate([
            'footer' => 'required|array',
            'footer.*' => 'nullable|string'
        ]);

        // footer[key] = value
        foreach ($request->footer as $key => $value)
        {
            Footer::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        return back()->with('success', 'Đã lưu thay đổi thành công!');
    }
}
