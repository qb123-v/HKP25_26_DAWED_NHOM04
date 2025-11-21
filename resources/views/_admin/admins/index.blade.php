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

                <!-- Nút thêm + Tìm kiếm -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <a href="{{ route('admin.admins.create') }}" class="btn btn-primary">
                                    <i class="fa-solid fa-plus"></i> Thêm tài khoản Admin
                                </a>
                            </div>
                            <div class="col-12 col-md-6 mt-3 mt-md-0">
                                <form method="get" action="{{ route('admin.admins.index') }}" class="d-flex">
                                    <input type="text" name="search" class="form-control me-2"
                                        placeholder="Nhập username hoặc email..." value="{{ request('search') }}">
                                    <button class="btn btn-outline-secondary" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
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
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th width="140" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr
                                        class="align-middle {{ $admin->id === auth('admin')->id() ? 'table-warning' : '' }}">
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
