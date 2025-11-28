@extends('_layouts.app')
@section('title', 'Tin tức Showbiz')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background-color: #fff;
        font-family: "Helvetica Neue", Arial, sans-serif;
    }

    .news-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 50px 40px;
    }

    h1.headline {
        font-size: 2.8rem;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    h2.subheadline {
        font-size: 1.4rem;
        color: #555;
        font-weight: 400;
        margin-bottom: 20px;
    }

    .article-meta {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 30px;
    }

    .main-image {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .caption {
        font-size: 0.85rem;
        color: #6c757d;
        font-style: italic;
    }

    .trending-box {
        background: #f8f9fa;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 20px;
    }

    .trending-box h5 {
        font-weight: 700;
        margin-bottom: 15px;
    }

    .trending-box ul {
        list-style: none;
        padding: 0;
    }

    .trending-box li {
        margin-bottom: 12px;
        padding-left: 20px;
        position: relative;
    }

    .trending-box li:before {
        content: "▸";
        position: absolute;
        left: 0;
        color: #0d6efd;
    }

    .trending-box a {
        color: #000;
        text-decoration: none;
        font-weight: 500;
    }

    .trending-box a:hover {
        color: #0d6efd;
        text-decoration: underline;
    }

    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #212529;
    }

    .article-content p {
        margin-bottom: 1.5rem;
    }

    .related-card {
        transition: all 0.2s ease;
        cursor: pointer;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 15px;
        background: #fff;
    }

    .related-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .related-card img {
        border-radius: 6px;
        width: 100%;
        height: 150px;
        object-fit: cover;
        margin-bottom: 10px;
    }

    .related-card h6 {
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 5px;
        color: #000;
    }

    .related-card p {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
    }

    .comments-section {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #e5e5e5;
    }

    .comments-box {
        border: 1px solid #ddd;
        background: #f8f9fa;
        border-radius: 8px;
        padding: 1.5rem;
    }

    .sidebar-sticky {
        position: sticky;
        top: 20px;
    }

    .article-stats {
        display: flex;
        gap: 15px;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .article-stats i {
        margin-right: 4px;
    }

    .suggested-article {
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        transition: all 0.2s ease;
        background: #fff;
    }

    .suggested-article:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .suggested-article img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        border-radius: 6px;
        margin-bottom: 10px;
    }

    .suggested-article h6 {
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .suggested-article .article-stats {
        font-size: 0.8rem;
    }

    @media (max-width: 992px) {
        .news-container {
            padding: 20px;
        }
        
        h1.headline {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
    <div class="p-5 row">
        <div class="col-md-8">
            <h3 class="mb-4">Danh sách bài viết</h3>
            @forelse ($articles as $article)
                <div class="card mb-3 w-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/articles/' . $article->thumbnail) }}"
                                class="img-fluid rounded-start h-100" style="object-fit: cover;" alt="{{ $article->title }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('articles.show', [$article->id, $article->slug]) }}"
                                    class="text-decoration-none text-dark">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                </a>
                                <p class="card-text">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                                <div class="article-stats">
                                    <span><i class="bi bi-eye"></i>{{ $article->views ?? 0 }} lượt xem</span>
                                    <span><i class="bi bi-heart"></i>{{ $article->likes_count ?? 0 }} thích</span>
                                    <span><i class="bi bi-clock"></i>{{ optional($article->created_at)->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Không có kết quả cho tìm kiếm "{{ request('search') }}"</div>
            @endforelse
            
            <!-- phân trang nếu quá 10 chuyên mục -->
            @if ($articles->lastPage() > 1)
                <ul class="pagination pagination-sm m-0 float-end">
                    {{-- Nút "Trước" --}}
                    @if ($articles->onFirstPage())
                        <li class="page-item disabled"><span class="page-link">«</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $articles->previousPageUrl() }}">«</a>
                        </li>
                    @endif

                    {{-- Danh sách các trang --}}
                    @for ($i = 1; $i <= $articles->lastPage(); $i++)
                        <li class="page-item {{ $i == $articles->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Nút "Sau" --}}
                    @if ($articles->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}">»</a></li>
                    @else
                        <li class="page-item disabled"><span class="page-link">»</span></li>
                    @endif
                </ul>
            @endif
        </div>
        
        <div class="col-md-4">
            <div class="sidebar-sticky">
                <h4 class="mb-3"><i class="bi bi-fire text-danger"></i> Tin gợi ý</h4>
                
                <!-- Suggestion Filter UI -->
                <form method="GET" action="" class="mb-3">
                    <div class="mb-2">
                        <input type="text" name="suggest_tag" class="form-control form-control-sm" placeholder="Lọc theo tag..." value="{{ request('suggest_tag') }}">
                    </div>
                    <div class="mb-2">
                        <input type="text" name="suggest_slug" class="form-control form-control-sm" placeholder="Lọc theo slug..." value="{{ request('suggest_slug') }}">
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="suggest_has_thumbnail" value="1" id="suggest_has_thumbnail" {{ request('suggest_has_thumbnail') ? 'checked' : '' }}>
                        <label class="form-check-label" for="suggest_has_thumbnail">
                            Chỉ bài có thumbnail
                        </label>
                    </div>
                    <button type="submit" class="btn btn-sm btn-outline-primary w-100">Lọc gợi ý</button>
                </form>
                <!-- End Suggestion Filter UI -->

                @forelse ($goi_ys as $goi_y)
                    <div class="suggested-article">
                        <a href="{{ route('articles.show', [$goi_y->id, $goi_y->slug]) }}" class="text-decoration-none">
                            <img src="{{ asset('storage/images/articles/' . $goi_y->thumbnail) }}" alt="{{ $goi_y->title }}">
                            <h6 class="text-dark">{{ Str::limit($goi_y->title, 60) }}</h6>
                            <div class="article-stats">
                                <span><i class="bi bi-eye"></i>{{ $goi_y->views ?? 0 }}</span>
                                <span><i class="bi bi-heart-fill text-danger"></i>{{ $goi_y->likes_count ?? 0 }}</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted">Chưa có tin gợi ý</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection