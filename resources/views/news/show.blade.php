@extends('_layouts.app')
@section('title', $article->title)

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Nền tổng thể đậm sặc sỡ */
        body {
            background: linear-gradient(135deg, #8e44ad, #e74c3c, #f1c40f, #16a085);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            font-family: "Helvetica Neue", Arial, sans-serif;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .news-container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 50px 40px;
            background-color: transparent;
            /* trong suốt, liền nền tổng thể */
        }

        /* Title */
        h1 {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(90deg, #ffdd00, #ff0055);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        h5 {
            font-size: 1.25rem;
            color: #fff8;
        }

        /* Breadcrumb */
        .breadcrumb a {
            text-decoration: none;
            font-weight: 600;
            color: #fff;
        }

        .breadcrumb a:hover {
            color: #ff0;
        }

        /* Meta */
        .article-meta {
            font-size: 0.95rem;
            font-weight: 500;
            color: #fff8;
        }

        /* Social icons */
        .social-icons a {
            font-size: 1.3rem;
            color: #fff;
            margin-right: 15px;
        }

        .social-icons a:hover {
            color: #ffdd00;
        }

        /* Article content */
        .article-content {
            font-size: 1.08rem;
            line-height: 1.8;
            color: #fff;
            background-color: rgba(255, 255, 255, 0.05);
            /* hơi mờ */
            padding: 25px;
            border-radius: 0;
            box-shadow: none;
            margin-bottom: 30px;
        }

        /* Related stories */
        .related-card {
            border-radius: 0;
            background-color: rgba(255, 255, 255, 0.05);
            box-shadow: none;
            padding: 10px;
            transition: transform 0.3s;
        }

        .related-card:hover {
            transform: scale(1.03);
        }

        .related-card img {
            border-radius: 0;
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .related-card h6 {
            font-weight: 700;
            font-size: 1rem;
            color: #ffdd00;
        }

        .related-card p {
            font-size: 0.85rem;
            color: #fff8;
        }

        /* Sidebar */
        .sidebar h6 {
            color: #ffdd00;
            font-weight: 700;
        }

        /* Trending */
        .trending {
            border: none;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 0;
            padding: 15px;
            margin-bottom: 25px;
        }

        .trending a {
            color: #fff8;
            font-weight: 600;
        }

        .trending a:hover {
            color: #ff0;
        }

        /* Comments */
        .comments-box {
            border: none;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 0;
            padding: 1rem;
            margin-top: 25px;
        }

        .comments-box h6 {
            font-weight: 700;
            color: #ffdd00;
        }

        .comment-reply {
            margin-left: 1rem;
            border-left: 2px solid #ff0;
            padding-left: 1rem;
            margin-top: 0.5rem;
        }

        .like-area {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 1.5rem;
        }

        .like-btn {
            border: none;
            background: none;
            color: #e74c3c;
            font-size: 1.5rem;
            cursor: pointer;
            transition: color 0.2s;
        }

        .like-btn:hover {
            color: #c0392b;
        }

        .like-count {
            font-size: 1.1rem;
            color: #e74c3c;
            font-weight: 500;
        }

        .comment-card {
            margin-bottom: 1.2rem;
            border-radius: 10px;
            border: 1px solid #e5e5e5;
            background: #fafbfc;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.03);
        }

        .comment-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            background: #eee;
        }

        .comment-header {
            display: flex;
            align-items: center;
            margin-bottom: 0.3rem;
        }

        .comment-author {
            font-weight: 600;
            margin-right: 10px;
        }

        .comment-date {
            color: #888;
            font-size: 0.95rem;
        }

        .comment-content {
            font-size: 1.08rem;
            color: #222;
            margin-bottom: 0.2rem;
        }

        .reply-btn {
            font-size: 0.95rem;
            color: #0d6efd;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .reply-card {
            margin-left: 60px;
            background: #f4f8fb;
            border-left: 3px solid #0d6efd;
        }

        .comment-form textarea {
            border-radius: 8px;
            resize: vertical;
        }

        /* Responsive */
        @media (min-width: 1200px) {
            .col-article {
                flex: 0 0 72%;
                max-width: 72%;
            }

            .col-sidebar {
                flex: 0 0 28%;
                max-width: 28%;
                padding-left: 40px;
            }
        }

        @media (max-width: 992px) {
            .news-container {
                padding: 20px;
            }

            .col-sidebar {
                padding-left: 0 !important;
                margin-top: 40px;
            }
        }
    </style>
@endpush
@push('stylesjs')
    <script>
        document.getElementById('copyLink').addEventListener('click', function (e) {
            e.preventDefault(); // chặn chuyển trang

            const link = this.href;

            navigator.clipboard.writeText(link).then(() => {
                alert("Đã copy link!");
            });
        });
    </script>
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

        <!-- Title -->
        <h1>{{ $article->title }}</h1>
        <h5 class="mb-2">{{ Str::limit(strip_tags($article->content ?? ''), 120) }}</h5>

        <div class="article-meta mb-3">
            By <strong>{{ $article->artist->name ?? 'Unknown' }}</strong> |
            {{ optional($article->created_at)->format('d M Y') }}
        </div>

        <!-- Main Image -->
        <div class="mb-3">
            <img src="{{ asset('storage/images/articles/' . $article->thumbnail) }}" class="img-fluid rounded"
                alt="{{ $article->title }}">
        </div>


        <!-- Social Icons -->
        <div class="social-icons mb-4">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-envelope"></i></a>
            <a href="#"><i class="bi bi-printer"></i></a>
        </div>

        <div class="row">
            <!-- Article -->
            <div class="col-12 col-lg-9 col-article">
                <div class="article-content">
                    {!! $article->content !!}
                </div>

                <!-- Like and Comment Count -->
                <div class="like-area mt-4 mb-4">
                    @php
                        $user = auth('user')->user();
                        $liked = $user ? $article->likes->contains($user->id) : false;
                        $likeCount = $article->likes_count ?? $article->likes()->count();
                    @endphp
                    <button
                        type="button"
                        class="like-btn"
                        id="like-btn"
                        data-liked="{{ $liked ? '1' : '0' }}"
                        @guest('user') disabled title="Vui lòng đăng nhập để thích bài viết" @endguest
                    >
                        <i id="like-icon" class="bi {{ $liked ? 'bi-heart-fill' : 'bi-heart' }}"></i>
                        <span id="like-btn-text">{{ $liked ? 'Bỏ thích' : 'Thích' }}</span>
                    </button>
                    <span class="like-count" id="like-count">{{ $likeCount }}</span> lượt thích
                    <span class="ms-3"><i class="bi bi-chat-dots text-primary"></i> {{ $article->comments->count() }} bình luận</span>
                </div>

                <!-- Comments Section -->
                <div class="comments-section mt-5">
                    @auth('user')
                    <div class="mb-4">
                        <form action="{{ route('articles.comment', $article->id) }}" method="POST" class="comment-form">
                            @csrf
                            <div class="mb-2">
                                <textarea name="content" rows="3" class="form-control" placeholder="Viết bình luận..." required></textarea>
                            </div>
                            <input type="hidden" name="parent_id" value="">
                            <button type="submit" class="btn btn-primary btn-sm">Gửi bình luận</button>
                        </form>
                    </div>
                    @else
                    <div class="alert alert-info">Vui lòng <a href="{{ route('user.login') }}">đăng nhập</a> để bình luận.</div>
                    @endauth

                    <h4 class="mb-4"><i class="bi bi-chat-dots text-primary"></i> Bình luận ({{ $article->comments->count() }})</h4>
                    @forelse ($article->comments as $comment)
                        <div class="card comment-card">
                            <div class="card-body">
                                <div class="comment-header">
                                    <img src="{{ $comment->user->avatar ?? asset('images/default-avatar.png') }}" class="comment-avatar" alt="avatar">
                                    <span class="comment-author">{{ $comment->user->name ?? 'Ẩn danh' }}</span>
                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-content">{{ $comment->content }}</div>
                                {{-- Reply button (UI only) --}}
                                <button class="reply-btn" type="button">Trả lời</button>
                            </div>
                            {{-- Replies --}}
                            @if ($comment->replies->count())
                                @foreach ($comment->replies as $reply)
                                    <div class="card-body reply-card">
                                        <div class="comment-header">
                                            <img src="{{ $reply->user->avatar ?? asset('images/default-avatar.png') }}" class="comment-avatar" alt="avatar">
                                            <span class="comment-author">{{ $reply->user->name ?? 'Ẩn danh' }}</span>
                                            <span class="comment-date">{{ $reply->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="comment-content">{{ $reply->content }}</div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    @empty
                        <div class="alert alert-secondary">Chưa có bình luận nào.</div>
                    @endforelse
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-12 col-lg-3 col-sidebar sidebar">


                <!-- Related Stories -->
                <h5 class="mt-5 fw-bold">Related stories</h5>
                <div class="row row-cols-1 row-cols-md-3 g-3 mt-2">
                    @foreach($relatedArticles as $related)
                        <div class="col">
                            <a href="{{ route('articles.show', [$related->id, $related->slug]) }}" class="text-decoration-none">
                                <div class="related-card">
                                    <img src="{{ asset('storage/images/articles/' . $related->thumbnail) }}"
                                        alt="{{ $related->title }}">
                                    <h6>{{ $related->title }}</h6>
                                    <p>{{ Str::limit(strip_tags($related->content ?? ''), 80) }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @auth('user')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeBtn = document.getElementById('like-btn');
            const likeBtnText = document.getElementById('like-btn-text');
            const likeIcon = document.getElementById('like-icon');
            const likeCountSpan = document.getElementById('like-count');
            if (likeBtn) {
                likeBtn.addEventListener('click', function() {
                    console.log('Like button clicked');
                    fetch("{{ route('articles.like', $article->id) }}", {
                        method: 'POST',
                        credentials: 'same-origin', // <-- add this line
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({})
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Server response:', data);
                        if (data.liked !== undefined) {
                            likeBtn.setAttribute('data-liked', data.liked ? '1' : '0');
                            likeBtnText.textContent = data.liked ? 'Bỏ thích' : 'Thích';
                            likeIcon.className = data.liked ? 'bi bi-heart-fill' : 'bi bi-heart';
                        }
                        if (data.like_count !== undefined) {
                            likeCountSpan.textContent = data.like_count;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }
        });
    </script>
    @else
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const likeBtn = document.getElementById('like-btn');
            if (likeBtn) {
                likeBtn.addEventListener('click', function() {
                    alert('Vui lòng đăng nhập để thích bài viết!');
                });
            }
        });
    </script>
    @endauth
@endsection