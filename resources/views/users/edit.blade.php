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
    <script>
        // Client-side validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('userUpdateForm');
            const avatarInput = document.querySelector('input[name="avatar"]');
            
            // Phone validation (Vietnamese phone format)
            const phoneInput = document.querySelector('input[name="phone"]');
            if (phoneInput) {
                phoneInput.addEventListener('input', function() {
                    const phoneRegex = /^(0|\+84)[0-9]{9}$/;
                    if (this.value && !phoneRegex.test(this.value)) {
                        this.setCustomValidity('Số điện thoại không hợp lệ (VD: 0912345678)');
                    } else {
                        this.setCustomValidity('');
                    }
                });
            }
            
            // Avatar file validation
            if (avatarInput) {
                avatarInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        // Validate file type
                        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
                        if (!validTypes.includes(file.type)) {
                            alert('Chỉ chấp nhận file ảnh (JPG, PNG, GIF)');
                            this.value = '';
                            return;
                        }
                        
                        // Validate file size (max 2MB)
                        if (file.size > 2048 * 1024) {
                            alert('Kích thước file không được vượt quá 2MB');
                            this.value = '';
                            return;
                        }
                        
                        // Validate image dimensions
                        const img = new Image();
                        img.onload = function() {
                            if (this.width < 100 || this.height < 100) {
                                alert('Kích thước ảnh tối thiểu 100x100 pixels');
                                avatarInput.value = '';
                            }
                        };
                        img.src = URL.createObjectURL(file);
                    }
                });
            }
            
            // Form submission validation
            form.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            });
        });
    </script>
@endpush



@section('content')
    <!-- viết nội dung cho trang chủ -->
    <div class="container" style="min-height: 80vh;">
        <h2 class="text-center">Cập nhật thông tin tài khoản</h2>

        {{-- Hiển thị thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Hiển thị lỗi chung --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form id="userUpdateForm" action="{{ url('/tai-khoan/cap-nhat-thong-tin') }}" method="POST" enctype="multipart/form-data" class="mt-3 needs-validation" novalidate>
            @csrf
            @method('PUT') {{-- hoặc PATCH tùy controller --}}

            <div class="mb-3">
                <label class="form-label">Tên <span class="text-danger">*</span></label>
                <input type="text" name="name" 
                    class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}"
                    required
                    minlength="2"
                    maxlength="255"
                    pattern="^[\p{L}\s]+$">
                <div class="invalid-feedback">Tên phải từ 2-255 ký tự và chỉ chứa chữ cái.</div>
                @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" name="email" 
                    class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}"
                    required
                    maxlength="255"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <div class="invalid-feedback">Email không hợp lệ (tối đa 255 ký tự).</div>
                @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="tel" name="phone" 
                    class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $user->phone ?? '') }}"
                    maxlength="20"
                    pattern="^(0|\+84)[0-9]{9}$"
                    placeholder="VD: 0912345678">
                <div class="invalid-feedback">Số điện thoại không hợp lệ (VD: 0912345678).</div>
                @error('phone') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Giới tính</label>
                <select name="gender" class="form-select @error('gender') is-invalid @enderror">
                    @php $gender = old('gender', $user->gender ?? null); @endphp
                    <option value="">-- Chọn --</option>
                    <option value="male" {{ $gender === 'male' ? 'selected' : '' }}>Nam</option>
                    <option value="female" {{ $gender === 'female' ? 'selected' : '' }}>Nữ</option>
                    <option value="other" {{ $gender === 'other' ? 'selected' : '' }}>Khác</option>
                </select>
                @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ngày sinh</label>
                <input type="date" name="birthday" 
                    class="form-control @error('birthday') is-invalid @enderror"
                    value="{{ old('birthday', isset($user->birthday) ? \Illuminate\Support\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}"
                    max="{{ date('Y-m-d') }}">
                <div class="invalid-feedback">Ngày sinh phải trước ngày hôm nay.</div>
                @error('birthday') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" rows="3" 
                    class="form-control @error('address') is-invalid @enderror"
                    maxlength="500">{{ old('address', $user->address ?? '') }}</textarea>
                <small class="text-muted">Tối đa 500 ký tự</small>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh đại diện</label>
                <input type="file" name="avatar" 
                    accept="image/jpeg,image/jpg,image/png,image/gif" 
                    class="form-control @error('avatar') is-invalid @enderror">
                <small class="text-muted">Chấp nhận JPG, PNG, GIF. Tối đa 2MB. Kích thước tối thiểu 100x100px.</small>
                @error('avatar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

                @if (!empty($user->avatar))
                    <div class="mt-2">
                        <img src="{{ asset($user->avatar) }}" alt="Avatar hiện tại"
                            style="height: 80px; width: 80px; object-fit: cover; border-radius: 8px;">
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Cập nhật
            </button>
            <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Hủy
            </a>
        </form>

    </div>
@endsection