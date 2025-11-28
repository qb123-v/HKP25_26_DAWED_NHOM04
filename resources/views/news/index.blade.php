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
    <div class="container">
        <div class="my-5 row">
            <div class="col-md-8">
                <h3>Danh sách bài viết</h3>
                @forelse ($articles as $article)
                    <div class="card mb-3 w-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/images/articles/' . $article->thumbnail) }}"
                                    class="img-fluid rounded-start w-100 " style="height: 200px; object-fit: cover;" alt="...">
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
                @empty
                    <div class="alert alert-warning">Không có kết quả cho tìm kiếm {{ request('search') }}</div>
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
                <h3 class="text-center">Tin gợi ý</h3>
                @foreach ($goi_ys as $goi_y)
                    <div class="card mb-3 w-100">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset('storage/images/articles/' . $goi_y->thumbnail) }}"
                                    class="img-fluid rounded-start w-100" style=" height: 150px; object-fit: cover;" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <a href="{{ route('articles.show', [$goi_y->id, $goi_y->slug])  }}"
                                        class="text-decoration-none">
                                        <h5 class="card-title">{{ $goi_y->title }}</h5>
                                    </a>
                                    <p class="card-text">{{ $goi_y->content }}</p>
                                    <p class="card-text"><small
                                            class="text-muted">{{ optional($goi_y->created_at)->diffForHumans() }}</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection