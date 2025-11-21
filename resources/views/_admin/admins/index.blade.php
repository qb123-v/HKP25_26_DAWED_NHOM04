@extends('_admin._layouts.app')
@section('title', 'Quản lý tài khoản Admin')

@push('style')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
@endpush

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý tài khoản Admin</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý tài khoản Admin</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">

                <!-- Thông báo -->
                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type', 'success') }} alert-dismissible fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- TÌM KIẾM + SẮP XẾP + NÚT THÊM ADMIN -->
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="get" action="{{ route('admin.admins.index') }}" class="row g-3 align-items-center">
                            <!-- Nút thêm -->
                            <div class="col-12 col-lg-3">
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary w-100">
                                    <i class="fa-solid fa-plus"></i> Thêm Admin mới
                                </a>
                            </div>

                            <!-- Ô tìm kiếm -->
                            <div class="col-12 col-lg-4">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Tìm username hoặc email..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Sắp xếp theo -->
                            <div class="col-6 col-lg-2">
                                <select name="sort" class="form-select" onchange="this.form.submit()">
                                    <option value="">Sắp xếp</option>
                                    <option value="username" {{ request('sort') == 'username' ? 'selected' : '' }}>Username
                                    </option>
                                    <option value="email" {{ request('sort') == 'email' ? 'selected' : '' }}>Email</option>
                                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Ngày
                                        tạo</option>
                                </select>
                            </div>

                            <!-- Tăng/giảm dần -->
                            <div class="col-6 col-lg-2">
                                <select name="direction" class="form-select" onchange="this.form.submit()">
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Tăng dần ↑
                                    </option>
                                    <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>
                                        Giảm dần ↓</option>
                                </select>
                            </div>

                            <!-- Nút reset -->
                            <div class="col-12 col-lg-1 text-end">
                                @if (request()->hasAny(['search', 'sort', 'direction']))
                                    <a href="{{ route('admin.admins.index') }}" class="btn btn-outline-danger"
                                        title="Xóa bộ lọc">
                                        <i class="fa-solid fa-rotate-left"></i>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Danh sách Admin -->
                <div class="card mb-4">
                    <div class="card-header">
                        Danh sách tài khoản Admin ({{ $admins->total() }} tài khoản)
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 10px" class="text-center">STT</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Ngày tạo</th>
                                    <th width="140" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr
                                        class="align-middle {{ $admin->id === auth('admin')->id() ? 'table-warning' : '' }} text-center">
                                        <td class="text-center fw-bold">
                                            {{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}
                                        </td>
                                        <td>
                                            <strong>
                                                {{ $admin->username }}
                                                @if ($admin->id === auth('admin')->id())
                                                    <span class="badge bg-success ms-2">Bạn</span>
                                                @endif
                                            </strong>
                                        </td>
                                        <td>{{ $admin->email }}</td>
                                        <td class="text-center text-muted">
                                            {{ $admin->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.admins.edit', $admin) }}"
                                                class="text-decoration-none text-warning" title="Sửa">
                                                <i class="fa-solid fa-pen-to-square fs-5"></i>
                                            </a>

                                            @if ($admin->id !== auth('admin')->id())
                                                <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Xóa tài khoản Admin này? Không thể khôi phục!')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 bg-transparent text-danger"
                                                        title="Xóa">
                                                        <i class="fa-solid fa-trash fs-5"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted" title="Không thể xóa chính mình">
                                                    <i class="fa-solid fa-ban fs-5"></i>
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            Không có tài khoản Admin nào được tìm thấy.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Phân trang -->
                    @if ($admins->lastPage() > 1)
                        <div class="card-footer clearfix">
                            <div class="float-start mt-1">
                                Hiển thị {{ $admins->count() }} trên tổng số {{ $admins->total() }} tài khoản
                            </div>
                            <ul class="pagination pagination-sm m-0 float-end">
                                @if ($admins->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link"
                                            href="{{ $admins->previousPageUrl() }}">«</a></li>
                                @endif

                                @for ($i = 1; $i <= $admins->lastPage(); $i++)
                                    <li class="page-item {{ $i == $admins->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $admins->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                @if ($admins->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $admins->nextPageUrl() }}">»</a>
                                    </li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>

            </div>
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection
