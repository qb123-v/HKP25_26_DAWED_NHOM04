@extends('_admin._layouts.app')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý Footer</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Quản lý Footer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-{{ session('alert-type', 'success') }}">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="bg-white rounded shadow p-4">
                    <form id="footerForm" class="row" method="POST" action="{{ route('admin.footers.update') }}">
                        @csrf
                        @method('PUT')
                        <!-- Cột trái -->
                        <div class="col-md-6 border-end pe-4">
                            <!-- Thông tin chung -->
                            <div class="mb-4">
                                <h5 class="fw-semibold border-bottom pb-2">Thông tin chung</h5>
                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Tên công ty</label>
                                        <input type="text" class="form-control" name="company_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Email liên hệ</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Số điện thoại</label>
                                        <input type="text" class="form-control" name="phone">
                                    </div>
                                </div>
                            </div>

                            <!-- Liên kết điều hướng -->
                            <div class="mb-4">
                                <h5 class="fw-semibold border-bottom pb-2">Liên kết điều hướng</h5>
                                <div class="mt-2">
                                    <label class="form-label">About</label>
                                    <input type="text" class="form-control mb-2" name="link_about">
                                    <label class="form-label">News</label>
                                    <input type="text" class="form-control mb-2" name="link_news">
                                    <label class="form-label">Services</label>
                                    <input type="text" class="form-control mb-2" name="link_services">
                                    <label class="form-label">Policies</label>
                                    <input type="text" class="form-control mb-2" name="link_policies">
                                </div>
                            </div>

                            <!-- Cấu hình hiển thị -->
                            <div>
                                <h5 class="fw-semibold border-bottom pb-2">Cấu hình hiển thị</h5>
                                <div class="row g-3 mt-2">
                                    <div class="col-md-6">
                                        <label class="form-label">Màu nền Footer</label>
                                        <input type="color" class="form-control form-control-color" name="bg_color"
                                            value="#f8f9fa">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Màu chữ</label>
                                        <input type="color" class="form-control form-control-color" name="text_color"
                                            value="#000000">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Căn chỉnh nội dung</label>
                                        <select class="form-select" name="align">
                                            <option value="center">Center</option>
                                            <option value="left">Left</option>
                                            <option value="right">Right</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Kích thước chữ</label>
                                        <select class="form-select" name="font_size">
                                            <option value="standard">Standard</option>
                                            <option value="small">Small</option>
                                            <option value="large">Large</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cột phải -->
                        <div class="col-md-6 ps-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-semibold mb-0">Xem trước Footer</h5>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-sm">Lưu thay đổi</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm">Trang
                                        chủ admin</a>
                                </div>
                            </div>

                            <div id="footerPreview" class="border rounded p-4 text-center"
                                style="background-color:#f8f9fa;">
                                <div class="row mb-4">
                                    <div class="col">
                                        <h6 class="fw-bold mb-2">About</h6>
                                        <p>About Us</p>
                                        <p>Contact</p>
                                        <p>Careers</p>
                                    </div>
                                    <div class="col">
                                        <h6 class="fw-bold mb-2">Services</h6>
                                        <p>Advertise</p>
                                        <p>RSS</p>
                                        <p>Apps</p>
                                    </div>
                                    <div class="col">
                                        <h6 class="fw-bold mb-2">Policies</h6>
                                        <p>Privacy Policy</p>
                                        <p>Terms of Use</p>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center gap-3 fs-5 mb-3">
                                    <i class="fab fa-facebook"></i>
                                    <i class="fab fa-twitter"></i>
                                    <i class="fab fa-instagram"></i>
                                    <i class="fab fa-youtube"></i>
                                </div>

                                <p class="text-muted small mb-0">© 2025 Your News Company. All rights reserved.</p>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!--end::App Content-->
    </main>
@endsection

@push('scripts')
    <script>
        // Cập nhật xem trước khi chọn màu
        document.querySelector('input[name="bg_color"]').addEventListener('input', e => {
            document.getElementById('footerPreview').style.backgroundColor = e.target.value;
        });

        document.querySelector('input[name="text_color"]').addEventListener('input', e => {
            document.getElementById('footerPreview').style.color = e.target.value;
        });
    </script>
@endpush