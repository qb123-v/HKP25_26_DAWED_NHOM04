@extends('_layouts.app')
@section('title', 'Thông tin tài khoản')

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
    <div class="container" style="min-height: 80vh;">
        <h2 class="text-center">Thông tin tài khoản</h2>
    </div>
@endsection