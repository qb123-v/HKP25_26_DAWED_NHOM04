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
                        <h3 class="mb-0">Thêm tin tức mới</h3>
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
                <form action="" method="post" novalidate>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">Thông tin chung</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="slug" class="form label">Đường dẫn bài viết</label>
                                        <input type="text" id="slug" class="form-control" name="slug">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tilte" class="form label">Tiêu đề bài viết</label>
                                        <input type="text" id="tilte" class="form-control" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form label">Mô tả bài viết</label>
                                        <textarea type="text" id="description" class="form-control"
                                            name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Nội dung chính</div>
                                <div class="card-body">

                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Các tác vụ</div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">Hình ảnh</div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Đăng bài viết</button>
                </form>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection