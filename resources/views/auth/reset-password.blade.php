@extends('_layouts.app')
@section('title', 'Đặt lại mật khẩu')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        .reset-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .toggle-all-password {
            cursor: pointer;
            background-color: #f8f9fa;
            border-left: 0;
        }
        .toggle-all-password:hover {
            background-color: #e9ecef;
        }
    </style>
@endpush

@push('stylesjs')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.querySelector('.toggle-all-password');
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const icon = toggleBtn.querySelector('i');

        toggleBtn.addEventListener('click', function() {
            const isPassword = passwordInput.type === 'password';

            passwordInput.type = isPassword ? 'text' : 'password';
            confirmInput.type = isPassword ? 'text' : 'password';

            if (isPassword) {
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });
</script>
@endpush

@section('content')
    <div class="container">
        <div class="card reset-card">
            <h4 class="text-center mb-4">Đặt lại mật khẩu</h4>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('user.reset-password.post') }}">
                @csrf
                <input type="hidden" name="token" value="{{ request()->token }}">
                <input type="hidden" name="email" value="{{ request()->email }}">

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label">Mật khẩu mới</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        <span class="input-group-text toggle-all-password">
                            <i class="bi bi-eye-slash"></i>
                        </span>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nhập lại mật khẩu -->
                <div class="mb-3">
                    <label class="form-label">Nhập lại mật khẩu</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100 rounded-pill">Cập nhật mật khẩu</button>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('user.login') }}" class="small">Quay về đăng nhập</a>
            </div>
        </div>
    </div>
@endsection