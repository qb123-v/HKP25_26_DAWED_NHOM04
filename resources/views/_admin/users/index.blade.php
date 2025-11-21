{{-- resources/views/_admin/users/index.blade.php --}}
@extends('_admin._layouts.app')
@section('title', 'Quản lý người dùng')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
@endpush

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý người dùng</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Người dùng</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Tìm kiếm + Sắp xếp -->
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="get" action="{{ route('admin.users.index') }}" class="row g-3 align-items-center">
                            <div class="col-12 col-md-5">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Tìm tên hoặc email..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="">Sắp xếp theo</option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Tên</option>
                                    <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Ngày
                                        đăng ký</option>
                                </select>
                            </div>

                            <div class="col-6 col-md-3">
                                <select name="direction" class="form-select" onchange="this.form.submit()">
                                    <option value="asc" {{ request('direction', 'desc') == 'asc' ? 'selected' : '' }}>
                                        Tăng dần ↑
                                    </option>
                                    <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                        Giảm dần ↓
                                    </option>
                                </select>
                            </div>

                            <div class="col-12 col-md-1 text-end">
                                @if (request()->hasAny(['search', 'sort', 'direction']))
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-danger"
                                        title="Xóa bộ lọc">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Danh sách -->
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Danh sách người dùng ({{ $users->total() }} người)
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-hover table-bordered mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" style="width: 30px">STT</th>
                                    <th class="text-center">Avatar</th>
                                    <th class="text-center">Họ tên</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Ngày đăng ký</th>
                                    <th class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr class="{{ $user->id === auth()->id() ? 'table-info' : '' }} text-center">
                                        <td class="text-center fw-bold">
                                            {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                                        </td>
                                        <td>
                                            <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/avatar.png') }}"
                                                class="rounded-circle" width="40" height="40" alt="Avatar">
                                        </td>
                                        <td>
                                            <strong>{{ $user->name }}</strong>
                                            @if ($user->id === auth()->id())
                                                <span class="badge bg-success ms-2">Bạn</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.users.edit', $user) }}" class="text-warning">
                                                <i class="fa-solid fa-pen-to-square fs-5"></i>
                                            </a>
                                            @if ($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent text-danger"
                                                        onclick="return confirm('Xóa người dùng này?')">
                                                        <i class="fa-solid fa-trash fs-5"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <i class="fa-solid fa-ban text-muted" title="Không thể xóa chính mình"></i>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Không có người dùng nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if ($users->lastPage() > 1)
                        <div class="card-footer">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
