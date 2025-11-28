<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Comment;
use App\Models\Subscription;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topArticles = Article::with('artist')
            ->withCount('comments as comments_count')
            ->orderByDesc('views')
            ->take(10)
            ->get();

        return view('_admin.dashboard', compact('topArticles'));
    }

    public function exportPdf()
{
    $topArticles = Article::with('artist')
        ->withCount('comments as comments_count')
        ->orderByDesc('views')
        ->take(20)
        ->get();

    $totalArticles = Article::count();
    $totalViews    = Article::sum('views');
    $totalComments = Comment::count();
    $totalSubscription = Subscription::count();

    $pdf = Pdf::loadView('_admin.pdf-dashboard', [
        'topArticles'   => $topArticles,
        'totalArticles' => $totalArticles,
        'totalViews'    => $totalViews,
        'totalComments' => $totalComments,
        'totalSubscription' => $totalSubscription,
        'generatedAt'   => now()->format('d/m/Y H:i'),
    ]);

    return $pdf->stream('Thong-ke-dashboard-' . now()->format('d-m-Y') . '.pdf');
}
}
