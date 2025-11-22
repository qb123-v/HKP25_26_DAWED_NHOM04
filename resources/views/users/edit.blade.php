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
        <h2 class="text-center">Cập nhật thông tin tài khoản</h2>

        <form action="">
            <div class="mb-3">
                <label for="" class="form-label">Tên</label>
                <input type="text" class="form-control" value="{{ $user->name }}">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Email</label>
                <input type="text" class="form-control" value="{{ $user->email }}">
            </div>
            <button class="btn btn-success">Cập nhật</button>
        </form>


    </div>
@endsection