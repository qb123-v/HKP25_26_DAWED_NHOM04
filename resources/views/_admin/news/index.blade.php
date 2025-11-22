@extends('_admin._layouts.app')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý tin tức</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý tin tức
                            </li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="row">
                    <!-- Left Sidebar Filters -->
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bộ lọc</h3>
                            </div>
                            <div class="card-body p-0">
                                <!-- Status Filters -->
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item bg-light">
                                        <small class="text-muted text-uppercase fw-bold">Trạng thái</small>
                                    </div>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>🗂️ Tất cả bài viết</span>
                                        <span class="badge bg-secondary">—</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>📝 Bản nháp</span>
                                        <span class="badge bg-secondary">—</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>✅ Đã xuất bản</span>
                                        <span class="badge bg-secondary">—</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <span>⏳ Chờ duyệt</span>
                                        <span class="badge bg-secondary">—</span>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-danger">
                                        <span>🗑️ Thùng rác</span>
                                        <span class="badge bg-danger">—</span>
                                    </a>
                                </div>
                                
                                <!-- Category Filters -->
                                <div class="list-group list-group-flush mt-2">
                                    <div class="list-group-item bg-light">
                                        <small class="text-muted text-uppercase fw-bold">Chuyên mục</small>
                                    </div>
                                    <a href="#" class="list-group-item list-group-item-action">🎬 Điện ảnh</a>
                                    <a href="#" class="list-group-item list-group-item-action">🎵 Âm nhạc</a>
                                    <a href="#" class="list-group-item list-group-item-action">⭐ Sao Việt</a>
                                    <a href="#" class="list-group-item list-group-item-action">🌍 Sao ngoại</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    <h3 class="card-title">Danh sách tin tức</h3>
                                    <div class="d-flex gap-2 flex-wrap">
                                        <a href="#" class="btn btn-primary btn-sm">
                                            <i class="fas fa-plus"></i> Tạo bài viết mới
                                        </a>
                                        <select class="form-select form-select-sm" style="width: auto;">
                                            <option>Tất cả trạng thái</option>
                                            <option>Bản nháp</option>
                                            <option>Đã xuất bản</option>
                                            <option>Chờ duyệt</option>
                                        </select>
                                        <select class="form-select form-select-sm" style="width: auto;">
                                            <option>Tất cả thể loại</option>
                                            <option>Điện ảnh</option>
                                            <option>Âm nhạc</option>
                                            <option>Sao Việt</option>
                                            <option>Sao ngoại</option>
                                        </select>
                                        <input type="text" class="form-control form-control-sm" placeholder="Tìm kiếm..." style="width: 200px;">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 40px;">
                                                    <input type="checkbox" class="form-check-input">
                                                </th>
                                                <th>Tiêu đề</th>
                                                <th style="width: 120px;">Trạng thái</th>
                                                <th style="width: 120px;">Tác giả</th>
                                                <th style="width: 140px;">Ngày tạo</th>
                                                <th style="width: 140px;">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach([1,2,3,4,5] as $i)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="form-check-input">
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div style="width: 56px; height: 38px; background: #f3f4f6; border: 1px solid #dee2e6; border-radius: 4px;"></div>
                                                        <div>
                                                            <div class="fw-bold">Bài viết demo số {{ $i }}</div>
                                                            <small class="text-muted">Mô tả ngắn nội dung bài viết...</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">Xuất bản</span>
                                                </td>
                                                <td>Admin</td>
                                                <td>
                                                    <small class="text-muted">12/11/2025</small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <button type="button" class="btn btn-info" title="Xem">
                                                            <i class="fas fa-eye"></i> Xem
                                                        </button>
                                                        <button type="button" class="btn btn-success" title="Sửa">
                                                            <i class="fas fa-edit"></i> Sửa
                                                        </button>
                                                        <button type="button" class="btn btn-danger" title="Xóa">
                                                            <i class="fas fa-trash"></i> Xóa
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Trước</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Sau</a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection