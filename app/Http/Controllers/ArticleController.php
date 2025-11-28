<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function index(Request $request)
    {
        $query = Article::with(['artist'])
            ->withCount('likes');
        
        // Lọc theo search title
        if ($request->filled('search'))
        {
            $query->where('title', 'like', '%' . $request->search . '%');
        } else
        {
            $query->orderBy('created_at', 'desc');
        }
        
        $articles = $query->paginate(10)->withQueryString();

        // Tin gợi ý với số lượt thích
        $goi_ys = Article::with(['artist'])
            ->withCount('likes')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
            
        return view('news.index', compact('articles', 'goi_ys'));
    }
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
        $data = $request->validate([
            'content' => 'required|string|max:2000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        Comment::create([
            'article_id' => $id,
            'user_id' => Auth::id(),
            'parent_id' => $data['parent_id'] ?: null,
            'content' => $data['content'],
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được gửi!');
    }
}
