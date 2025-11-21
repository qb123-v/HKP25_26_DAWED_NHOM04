{{-- resources/views/_admin/users/edit.blade.php --}}
@extends('_admin._layouts.app')
@section('title', 'Sửa người dùng')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <h3>Sửa thông tin người dùng</h3>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Họ tên</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Mật khẩu mới (để trống nếu không đổi)</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Cập nhật</button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection