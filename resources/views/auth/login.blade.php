@extends('_layouts.app')
@section('title', 'Đăng nhập tài khoản')

@push('styles')
    <!-- Ai sử dụng framework nào thì bỏ comment dòng đó -->

    <!-- Dòng này cho tailwind -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->

    <!-- Dòng này cho bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

@endpush

<!-- Dùng để import CDN/file js -->
@push('stylesjs')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const icon = document.getElementById('toggleIcon');

            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    </script>
@endpush

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%; border-radius: 12px;">
            <h4 class="text-center mb-4 fw-bold">Đăng nhập tài khoản</h4>

            <form method="POST" action="{{ route('user.login.post') }}" novalidate>
                @csrf
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" name="email" class="form-control" placeholder="Nhập email"
                        value="{{ old('email') }}" autofocus>
                    @error('email')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 position-relative">
                    <label for="password" class="form-label">Mật khẩu</label>

                    <div class="input-group">
                        <input id="password" type="password" name="password" class="form-control"
                            placeholder="Nhập mật khẩu" value="{{ old('password') }}">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fa fa-eye" id="toggleIcon"></i>
                        </button>

                    </div>
                    @error('password')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror

                    <div class="text-end mt-1">
                        <a href="" class="small text-decoration-none">Quên mật khẩu?</a>
                    </div>
                </div>

                <!-- Nút đăng nhập -->
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-dark rounded-pill py-2">Đăng nhập</button>
                </div>
            </form>

            <!-- Nút đăng ký -->
            <div class="d-grid mt-3">
                <a href="" class="btn btn-outline-dark rounded-pill py-2">Đăng ký</a>
            </div>

            <!-- OR -->
            <div class="text-center my-3 text-muted">
                <span>OR</span>
            </div>

            <!-- Login with Google -->
            <div class="d-grid mb-2">
                <a href="" class="btn btn-outline-danger rounded-pill py-2">
                    <i class="bi bi-google me-2"></i> Continue with Google
                </a>
            </div>

            <!-- Login with Facebook -->
            <div class="d-grid">
                <a href="" class="btn btn-outline-primary rounded-pill py-2">
                    <i class="bi bi-facebook me-2"></i> Continue with Facebook
                </a>
            </div>

        </div>
    </div>
@endsection