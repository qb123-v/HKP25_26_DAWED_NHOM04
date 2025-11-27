<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;

class PageIndexController extends Controller
{
    public function index()
    {
        $categories = Categorie::all();
        $articles = Article::latest()->paginate(10);
        $goi_ys = Article::mostViewed()->get();
        $topCategories = Categorie::withSum('articles', 'views')
            ->orderBy('articles_sum_views', 'desc')
            ->take(4)
            ->get();
        return view('index', compact('categories', 'articles', 'goi_ys', 'topCategories'));
    }
}
