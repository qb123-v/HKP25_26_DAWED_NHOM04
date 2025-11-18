<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscriptions,email'
        ], [
            'email.required' => 'Email không được để trống!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email này đã đăng ký rồi!'
        ]);

        $subscription = Subscription::create([
            'email' => $request->email,
            'user_id' => Auth::id()
        ]);

        // Gửi email chào mừng
        Mail::to($subscription->email)->queue(new NewsletterMail($subscription));

        return response()->json([
            'success' => true,
            'message' => 'Đăng ký thành công! Check email để xác nhận.',
            'email' => $request->email
        ]);
    }
}
