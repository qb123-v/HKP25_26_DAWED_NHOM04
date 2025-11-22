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
            <img src="{{ asset('images/articles/' . $article->thumbnail) }}" class="img-fluid rounded"
                alt="{{ $article->title }}">
        </div>

        <!-- Social Icons -->
        <div class="social-icons mb-4">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
            <a href="#"><i class="bi bi-envelope"></i></a>
            <a href="#"><i class="bi bi-printer"></i></a>
            <a id="copyLink" href="{{ route('articles.show', [$article->id, $article->slug]) }}">
                <i class="bi bi-link-45deg"></i>
            </a>

        </div>

        <div class="row">
            <!-- Article -->
            <div class="col-12 col-lg-9 col-article">
                <div class="article-content">
                    {!! nl2br(e($article->content ?? '')) !!}
                </div>

                <!-- Related Stories -->
                <h5 class="mt-5 fw-bold">Related stories</h5>
                <div class="row row-cols-1 row-cols-md-3 g-3 mt-2">
                    @foreach($relatedArticles as $related)
                        <div class="col">
                            <a href="{{ route('articles.show', [$related->id, $related->slug]) }}" class="text-decoration-none">
                                <div class="related-card">
                                    <img src="{{ asset('images/articles/' . $related->thumbnail) }}"
                                        alt="{{ $related->title }}">
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


                <div class="comments-box">
                    <h6>Leave a Comment</h6>
                    @auth('user')
                        <form action="{{ route('articles.comment', $article->id) }}" method="POST">
                            @csrf
                            <textarea name="content" class="form-control mb-2" placeholder="Viết bình luận..." rows="3"
                                required></textarea>
                            <button class="btn btn-primary btn-sm w-100">Gửi</button>
                        </form>
                    @else
                        <p><a href="{{ route('user.login') }}" class="text-primary">Đăng nhập</a> để bình luận.</p>
                    @endauth

                    @foreach($article->comments->where('status', 1) as $comment) <!-- chỉ hiển thị status=1 -->
                        <div class="mt-3">
                            <strong>{{ $comment->user->name ?? 'Unknown' }}</strong>
                            <small class="text-muted d-block">{{ optional($comment->created_at)->diffForHumans() }}</small>
                            <p>{{ $comment->content }}</p>

                            @foreach($comment->replies->where('status', 1) as $reply) <!-- lọc replies status=1 -->
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