@extends('_layouts.app')
@section('title', 'Quên mật khẩu')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        #responseModal .modal-content {
            border-radius: 16px;
            overflow: hidden;
        }

        #responseModal .btn-close {
            opacity: 0.7;
        }

        #responseModal .btn-close:hover {
            opacity: 1;
        }

        #responseModal .display-1 {
            font-size: 4rem;
        }
    </style>
@endpush

@push('stylesjs')
    <!-- BOOTSTRAP JS - XÓA INTEGRITY ĐỂ TRÁNH LỖI CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('message'))
                showModal(
                    'success',
                    'Thành công!',
                    `{!! addslashes(session('message')) !!}`,
                    'check-circle-fill'
                );
            @endif

            @if ($errors->any())
                let errorMsg = '';
                @foreach ($errors->all() as $error)
                    errorMsg += `{{ $error }}\n`;
                @endforeach
                showModal('danger', 'Lỗi!', errorMsg.trim(), 'x-circle-fill');
            @endif
        });

        function showModal(type, title, message, icon) {
            const modalEl = document.getElementById('responseModal');
            const modal = new bootstrap.Modal(modalEl);

            const iconEl = document.getElementById('modal-icon');
            const titleEl = document.getElementById('modal-title');
            const msgEl = document.getElementById('modal-message');

            const isSuccess = type === 'success';
            const iconColor = isSuccess ? '#0d6efd' : '#dc3545';

            iconEl.innerHTML = `<i class="bi bi-${icon} display-1" style="color: ${iconColor};"></i>`;
            titleEl.textContent = title;
            titleEl.style.color = iconColor;
            msgEl.textContent = message;

            modal.show();
            setTimeout(() => modal.hide(), 5000);
        }
    </script>
@endpush

@section('content')
    <!-- Modal Popup -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div id="modal-icon" class="mb-3"></div>
                    <h5 id="modal-title" class="mb-2"></h5>
                    <p id="modal-message" class="text-muted mb-0"></p>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <button type="button" class="btn btn-primary rounded-pill px-4" data-bs-dismiss="modal">
                        Đóng
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container forgot-password-container">
        <div class="forgot-password-card">
            <h3 class="text-center mb-4">Quên mật khẩu</h3>

            <form method="POST" action="{{ route('user.forgot-password.post') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        name="email" value="{{ old('email') }}" required autofocus placeholder="Nhập email của bạn">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-2">
                    <button type="submit" class="btn btn-primary rounded-pill">Gửi yêu cầu</button>
                </div>

                <div class="d-grid">
                    <a href="{{ route('user.login') }}" class="btn btn-outline-secondary rounded-pill border-0">
                        Quay về trang đăng nhập
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
