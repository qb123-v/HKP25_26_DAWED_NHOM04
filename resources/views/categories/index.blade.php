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
        <div class="row mb-5">
            <h3 class="my-3">Các chuyên mục</h3>
            @foreach($categories as $category)
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
        </div>
    </div>
@endsection