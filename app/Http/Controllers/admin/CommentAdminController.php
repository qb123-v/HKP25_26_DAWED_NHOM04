<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CommentAdmin;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class CommentAdminController extends Controller
{
    // Trang danh sách bình luận
    public function index(Request $request)
    {
        $query = CommentAdmin::with(['user', 'article'])->orderBy('created_at', 'DESC');

        // Filter theo article
        if ($request->article) {
            $query->where('article_id', $request->article);
        }

        // Filter theo user
        if ($request->user) {
            $query->where('user_id', $request->user);
        }

        // Filter theo status
        if ($request->status !== null && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $comments = $query->paginate(10);
        $articles = Article::all();
        $users = User::all();

        return view('_admin.comments.index', compact('comments', 'articles', 'users'));
    }

    // Duyệt comment
    public function approve($id)
    {
        CommentAdmin::where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'Bình luận đã được duyệt!');
    }

    // Ẩn comment
    public function hide($id)
    {
        CommentAdmin::where('id', $id)->update(['status' => 2]);
        return back()->with('success', 'Bình luận đã bị ẩn!');
    }

    // Hiển thị lại comment
    public function showAgain($id)
    {
        CommentAdmin::where('id', $id)->update(['status' => 1]);
        return back()->with('success', 'Bình luận đã được hiển thị lại!');
    }
}
