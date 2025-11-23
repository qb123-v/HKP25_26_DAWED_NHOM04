@extends('_layouts.app')
@section('title', 'Danh sách tin tức')

@push('styles')
    <!-- Ai sử dụng framework nào thì bỏ comment dòng đó -->

    <!-- Dòng này cho tailwind -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->

    <!-- Dòng này cho bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endpush

<!-- Dùng để import CDN/file js -->
@push('stylesjs')
    <!-- import js vào đây -->
@endpush


@section('content')
    <div class="p-5 row">
        <div class="col-md-8">
            <h3>Danh sách bài viết</h3>
            @foreach ($articles as $article)
                <div class="card mb-3 w-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/articles/' . $article->thumbnail) }}"
                                class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('articles.show', [$article->id, $article->slug])  }}"
                                    class="text-decoration-none">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                </a>
                                <p class="card-text">{{ $article->content }}</p>
                                <p class="card-text"><small
                                        class="text-muted">{{ optional($article->created_at)->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <div class="col-md-4">
            <h3 class="text-center">Tin gợi ý</h3>
            @foreach ($articles as $article)
                <div class="card mb-3 w-100">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/articles/' . $article->thumbnail) }}"
                                class="img-fluid rounded-start" alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <a href="{{ route('articles.show', [$article->id, $article->slug])  }}"
                                    class="text-decoration-none">
                                    <h5 class="card-title">{{ $article->title }}</h5>
                                </a>
                                <p class="card-text">{{ $article->content }}</p>
                                <p class="card-text"><small
                                        class="text-muted">{{ optional($article->created_at)->diffForHumans() }}</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection