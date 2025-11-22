<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Artist;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::with(['artist', 'categorie'])
            ->latest()
            ->paginate(10);
        return view('_admin.articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        $artists = Artist::all();
        return view('_admin.articles.create', compact('categories', 'artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Xử lý lưu tin tức mới
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tìm bài viết theo ID, kèm quan hệ
        $article = Article::with(['artist', 'categorie'])->findOrFail($id);

        // Lấy categories và artists để hiển thị trong form edit
        $categories = Categorie::all();
        $artists = Artist::all();
        return view('_admin.articles.edit', compact('article', 'categories', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        return redirect(back());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Xử lý xóa tin tức
    }
    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload'))
        {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ckeditor'), $filename);

            $url = asset('uploads/ckeditor/' . $filename);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
    }
}
