<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class ArticleController extends Controller
{
    // Hiển thị chi tiết bài viết
    public function show($id, $slug)
    {
        $article = Article::with([
            'artist',
            'comments.user',
            'comments.replies.user'
        ])->findOrFail($id);

        $article->increment('views');

        $relatedArticles = $article->relatedArticles();

        return view('news.show', compact('article', 'relatedArticles'));
    }

    // Lưu comment hoặc reply
    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'article_id' => $id,
            'user_id' => Auth::id(),
            'parent_id' => $request->input('parent_id') ?: null,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được gửi!');
    }
}
