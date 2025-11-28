<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

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
        
        // Change from paginate(10) to paginate(5)
        $articles = $query->paginate(5)->withQueryString();

        // Tin gợi ý với số lượt thích - apply filters
        $goiYQuery = Article::with(['artist'])
            ->withCount('likes')
            ->orderBy('views', 'desc');

        // Filter by tag
        if ($request->filled('suggest_tag')) {
            $goiYQuery->where('tag', 'like', '%' . $request->suggest_tag . '%');
        }

        // Filter by slug
        if ($request->filled('suggest_slug')) {
            $goiYQuery->where('slug', 'like', '%' . $request->suggest_slug . '%');
        }

        // Filter by thumbnail existence
        if ($request->has('suggest_has_thumbnail')) {
            $goiYQuery->whereNotNull('thumbnail')->where('thumbnail', '!=', '');
        }

        $goi_ys = $goiYQuery->take(5)->get();
            
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
            'parent_id' => $data['parent_id'] ?? null,
            'content' => $data['content'],
        ]);

        return redirect()->back()->with('success', 'Bình luận đã được gửi!');
    }

    // Toggle like for an article
    public function toggleLike(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $article = Article::findOrFail($id);

        // Assuming 'likes' is a many-to-many relationship on Article model
        if ($article->likes()->where('user_id', $user->id)->exists()) {
            $article->likes()->detach($user->id);
            $liked = false;
        } else {
            $article->likes()->attach($user->id);
            $liked = true;
        }

        $likeCount = $article->likes()->count();

        // For debugging
        \Log::info("User {$user->id} toggled like for article {$id}. Liked: " . ($liked ? 'yes' : 'no'));

        return response()->json([
            'liked' => $liked,
            'like_count' => $likeCount,
        ]);
    }
}
