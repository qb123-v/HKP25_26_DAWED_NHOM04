<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }
    public function show($slug)
    {
        $categorie = Categorie::where('slug', $slug)->firstOrFail();
        $articles = $categorie->articles()->paginate(10); // Phân trang, 10 bài viết mỗi trang
        $goi_ys = Article::mostViewed()->get();
        return view('news.index', compact('categorie', 'articles', 'goi_ys'));
    }
}
