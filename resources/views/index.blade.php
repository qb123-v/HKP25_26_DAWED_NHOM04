@extends('_layouts.app')
@section('title', 'Hóng hớt showbiz siêu cấp vip pro')

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
    <!-- viết nội dung cho trang chủ -->

    <div class="container">
        <div class="row my-5">
            <div class="col-md-8">
                <h3 class="mb-3">Đáng chú ý</h3>
                @foreach ($articles->take(2) as $article)
                    <a href="{{ route('articles.show', [$article->id, $article->slug]) }}"
                        class="text-decoration-none text-dark">
                        <div class="card border-0 mb-3" style="height: 400px;">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $article->title }}</h5>
                                        <p class="card-text">Mô tả: {{ $article->description }}</p>
                                        <p class="card-text">
                                            <small
                                                class="text-body-secondary">{{ $article->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-8" style="height: 400px; overflow: hidden;"> <img
                                        src="{{ asset('storage/images/articles/' . $article->thumbnail) }}"
                                        class="rounded-end w-100 h-100" style="object-fit: fill;" alt="{{ $article->title }}">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
                <div class="mt-5 row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($articles->skip(2) as $article)
                        <div class="col">
                            <a href="{{ route('articles.show', [$article->id, $article->slug]) }}"
                                class="text-decoration-none text-dark">
                                <div class="card border-0 h-100">
                                    <img class="h-100" style="height: 180px;"
                                        src="{{ asset('storage/images/articles/' . $article->thumbnail) }}" class="card-img-top"
                                        alt="{{ $article->title }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $article->title }}</h5>
                                        <p class="card-text">{{ $article->description }}</p>
                                        <small class="text-body-secondary">{{ $article->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-md-4">
                <h3 class="mb-3">Nổi bật trong tuần</h3>
                @php
                    $first = $goi_ys->first();
                @endphp
                <a href="{{ route('articles.show', [$first->id, $first->slug]) }}" class="text-decoration-none text-dark">
                    <div class="card border-0">
                        <img src="{{ asset('storage/images/articles/' . $first->thumbnail) }}" class="card-img-top"
                            alt="...">
                        <div class="card-body">
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                                the
                                card’s content.</p>
                        </div>
                    </div>
                </a>
                @foreach($goi_ys->skip(1) as $goi_y)
                    <a href="{{ route('articles.show', [$goi_y->id, $goi_y->slug]) }}" class="text-decoration-none text-dark">
                        <div class="card border-0 border-top py-4 ">
                            <div class="row g-0">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $goi_y->title }}</h5>
                                        <p class="card-text">Mô tả: {{ $goi_y->description }}</p>
                                        <p class="card-text">
                                            <small class="text-body-secondary">{{ $goi_y->created_at->diffForHumans() }}</small>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-4" style="height: 100px; overflow: hidden;"> <img
                                        src="{{ asset('storage/images/articles/' . $goi_y->thumbnail) }}"
                                        class="rounded-end w-100 h-100" style="object-fit: fill;" alt="{{ $goi_y->title }}">
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row mb-5">
            <h3 class="mb-3">Các chuyên mục</h3>
            @foreach($topCategories as $category)
                <div class="col-md-3 mb-3">
                    <a href="{{ route('categories.show', $category->slug) }}">
                        <div class="card text-bg-dark">
                            <img onerror="this.src='{{ asset('assets/img/imageerror.jpg') }}'"
                                style="height: 200px; object-fit: cover;"
                                src="{{ asset('storage/images/categories/' . $category->thumbnail) }}" class="card-img"
                                alt="{{ $category->name }}">
                            <div class="card-img-overlay">
                                <h5 class="card-title">{{ $category->name }}</h5>
                                <p class="card-text">{{ $category->description }}</p>
                                <p class="card-text"><small></small></p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
            <a style="width: 200px;" href="{{ route('categories.index') }}" class="btn btn-dark mx-auto">Xem tất
                cả</a>
        </div>
    </div>
@endsection