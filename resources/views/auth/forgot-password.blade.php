@extends('_layouts.app')
@section('title', 'Quên mật khẩu')

@push('styles')
    <!-- Ai sử dụng framework nào thì bỏ comment dòng đó -->

    <!-- Dòng này cho tailwind -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->

    <!-- Dòng này cho bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
         <style>
        /* Center form vertically */
        .forgot-password-container {
            min-height: 80vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forgot-password-card {
            padding: 2rem;
            border: 1px solid #ccc;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .forgot-password-card button {
            border-radius: 50px;
        }

        .forgot-password-card .mb-3 {
            margin-bottom: 1rem !important;
        }
    </style>
@endpush

<!-- Dùng để import CDN/file js -->
@push('stylesjs')
    <!-- import js vào đây -->
@endpush


@section('content')
    <!-- viết nội dung cho trang chủ -->
    <div class="container forgot-password-container">
    <div class="forgot-password-card">
        <h3 class="text-center mb-4">Quên mật khẩu</h3>

        {{-- <form method="POST" action="{{ route('password.email') }}"></form> --}}

        <form method="POST" action="">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="Nhập email của bạn">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary">Gửi yêu cầu</button>
            </div>

            <div class="d-grid">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Quay về trang đăng nhập</a>
            </div>
        </form>
    </div>
</div>
@endsection