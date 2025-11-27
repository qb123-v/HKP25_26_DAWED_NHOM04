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

        {{-- Hiển thị lỗi chung --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/tai-khoan/cap-nhat-thong-tin') }}" method="POST" enctype="multipart/form-data" class="mt-3">
            @csrf
            @method('PUT') {{-- hoặc PATCH tùy controller --}}

            <div class="mb-3">
                <label class="form-label">Tên</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $user->phone ?? '') }}">
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                <input type="date" name="birthday" class="form-control @error('birthday') is-invalid @enderror"
                    value="{{ old('birthday', isset($user->birthday) ? \Illuminate\Support\Carbon::parse($user->birthday)->format('Y-m-d') : '') }}">
                @error('birthday') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Địa chỉ</label>
                <textarea name="address" rows="3" class="form-control @error('address') is-invalid @enderror">{{ old('address', $user->address ?? '') }}</textarea>
                @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Ảnh đại diện</label>
                <input type="file" name="avatar" accept="image/*" class="form-control @error('avatar') is-invalid @enderror">
                @error('avatar') <div class="invalid-feedback">{{ $message }}</div> @enderror

                @if (!empty($user->avatar))
                    <div class="mt-2">
                        <img src="{{ asset($user->avatar) }}" alt="Avatar hiện tại"
                            style="height: 80px; width: 80px; object-fit: cover; border-radius: 8px;">
                    </div>
                @endif
            </div>

            <button class="btn btn-success">Cập nhật</button>
        </form>


    </div>
@endsection