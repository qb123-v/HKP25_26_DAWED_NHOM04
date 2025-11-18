@extends('_layouts.app')
@section('title', $article->title)

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body { background-color: #fff; font-family: "Helvetica Neue", Arial, sans-serif; }
    .news-container { max-width: 1400px; margin: 0 auto; padding: 50px 40px; }
    h1 { font-size: 2.6rem; font-weight: 700; margin-bottom: 10px; }
    h5 { font-size: 1.25rem; color: #555; }
    .breadcrumb { font-size: 0.9rem; }
    .breadcrumb a { text-decoration: none; color: #007bff; }
    .breadcrumb a:hover { text-decoration: underline; }
    .article-meta { font-size: 0.9rem; color: #6c757d; }
    .social-icons a { font-size: 1.3rem; color: #333; margin-right: 15px; }
    .social-icons a:hover { color: #0d6efd; }
    .article-content { font-size: 1.05rem; line-height: 1.8; color: #212529; }

    .related-card { transition: all 0.2s ease; cursor: pointer; }
    .related-card:hover { transform: translateY(-3px); }
    .related-card img { border-radius: 8px; width: 100%; height: 180px; object-fit: cover; }
    .related-card h6 { font-weight: 600; font-size: 0.95rem; margin-top: 8px; margin-bottom: 5px; color: #000; }
    .related-card p { font-size: 0.85rem; color: #6c757d; }

    .comments-box { border: 1px solid #ddd; background: #f8f9fa; border-radius: 6px; padding: 1rem; margin-bottom: 1.5rem; }
    .comments-box h6 { font-weight: 600; margin-bottom: 0.5rem; }
    .comment-reply { margin-left: 1rem; border-left: 2px solid #ccc; padding-left: 1rem; margin-top: 0.5rem; }

    @media (min-width: 1200px) {
        .col-article { flex: 0 0 72%; max-width: 72%; }
        .col-sidebar { flex: 0 0 28%; max-width: 28%; padding-left: 40px; }
    }

    @media (max-width: 992px) {
        .news-container { padding: 20px; }
        .col-sidebar { padding-left: 0 !important; margin-top: 40px; }
    }
</style>
@endpush

@section('content')
<div class="news-container">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">{{ $article->categorie->name ?? 'Category' }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $article->title }}</li>
        </ol>
    </nav>

    <!-- Headline -->
    <h1>{{ $article->title }}</h1>
    <h5 class="mb-2">{{ Str::limit(strip_tags($article->content ?? ''), 120) }}</h5>
    <div class="article-meta mb-3">
        By <strong>{{ $article->artist->name ?? 'Unknown' }}</strong> | 
        {{ optional($article->created_at)->format('d M Y') }}
    </div>

    <!-- Main image -->
    <div class="mb-3">
        <img src="{{ $article->thumbnail ?? 'https://via.placeholder.com/1300x550' }}" class="img-fluid rounded" alt="{{ $article->title }}">
    </div>

    <!-- Social icons -->
    <div class="social-icons mb-4">
        <a href="#"><i class="bi bi-facebook"></i></a>
        <a href="#"><i class="bi bi-twitter"></i></a>
        <a href="#"><i class="bi bi-envelope"></i></a>
        <a href="#"><i class="bi bi-printer"></i></a>
    </div>

    <div class="row">
        <!-- Main article -->
        <div class="col-12 col-lg-9 col-article">
            <div class="article-content">
                {!! nl2br(e($article->content ?? '')) !!}
            </div>

            <!-- Related stories -->
            <h5 class="mt-5 fw-bold">Related stories</h5>
            <div class="row row-cols-1 row-cols-md-3 g-3 mt-2">
                @foreach($relatedArticles as $related)
                <div class="col">
                    <a href="{{ route('articles.show', [$related->id, $related->slug]) }}" class="text-decoration-none">
                        <div class="related-card">
                            <img src="{{ $related->thumbnail ?? 'https://via.placeholder.com/300x180' }}" alt="{{ $related->title }}">
                            <h6>{{ $related->title }}</h6>
                            <p>{{ Str::limit(strip_tags($related->content ?? ''), 80) }}</p>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-12 col-lg-3 col-sidebar sidebar">

            <!-- Trending -->
            <div class="border rounded p-3 mb-4 trending">
                <h6 class="fw-bold">Trending</h6>
                <ul class="list-unstyled mb-0">
                    <li><a href="#">Top story 1</a></li>
                    <li><a href="#">Top story 2</a></li>
                    <li><a href="#">Top story 3</a></li>
                    <li><a href="#">Top story 4</a></li>
                    <li><a href="#">Top story 5</a></li>
                </ul>
            </div>

            <!-- Comment box nhỏ -->
            <div class="comments-box">
                <h6>Leave a Comment</h6>

                @auth('user')
                <form action="{{ route('articles.comment', $article->id) }}" method="POST">
                 @csrf
                    <textarea name="content" class="form-control mb-2" placeholder="Viết bình luận..." rows="3" required></textarea>
                    <button class="btn btn-primary btn-sm w-100">Gửi</button>
                </form>
                @else
                    <p><a href="{{ route('user.login') }}">Đăng nhập</a> để bình luận.</p>
                @endauth

                <!-- Hiển thị các comment đã gửi -->
                @foreach($article->comments as $comment)
                <div class="mt-3">
                    <strong>{{ $comment->user->name ?? 'Unknown' }}</strong>
                    <small class="text-muted d-block">{{ optional($comment->created_at)->diffForHumans() }}</small>
                    <p>{{ $comment->content }}</p>

                    <!-- Hiển thị replies nếu có -->
                    @foreach($comment->replies as $reply)
                    <div class="comment-reply">
                        <strong>{{ $reply->user->name ?? 'Unknown' }}</strong>
                        <small class="text-muted d-block">{{ optional($reply->created_at)->diffForHumans() }}</small>
                        <p>{{ $reply->content }}</p>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>

        </div>
    </div>
</div>
@endsection
