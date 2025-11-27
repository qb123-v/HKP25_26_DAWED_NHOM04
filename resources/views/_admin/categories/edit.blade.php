@extends('_admin._layouts.app')

@push('stylejs')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>


    <script>
        function slugify(str) {
            return str
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        }

        $(document).ready(function () {
            const $titleInput = $("#tilte");
            const $slugInput = $("#slug");
            const $check = $("#flexCheckDefault");

            $titleInput.on("input", function () {
                if (!$check.is(":checked")) {
                    $slugInput.val(slugify($(this).val()));
                }
            });

            $check.on("change", function () {
                if ($(this).is(":checked")) {
                    $slugInput.prop("readonly", false);
                } else {
                    $slugInput.prop("readonly", true)
                        .val(slify($titleInput.val()));
                }
            });

            // Preview thumbnail image
            $("#thumbnail").on("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (evt) {
                        $("#thumbnail-img").attr("src", evt.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

    </script>
@endpush


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
                        <h3 class="mb-0">Cập nhật chuyên mục</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý chuyên mục
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
                <form action="{{ route('admin.categories.store') }}" method="post" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">Thông tin chung</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Đường dẫn chuyên mục (được tạo tự động khi nhập
                                            tiêu đề)</label>
                                        <input type="text" id="slug"
                                            class="form-control @error('slug') is-invalid @enderror" name="slug"
                                            value="{{ old('slug', $categorie->slug) }}" readonly>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Chỉnh sửa đường dẫn
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Tiêu đề chuyên mục</label>
                                        <input type="text" id="tilte"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name', $categorie->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea name="description" id="description"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $categorie->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">Hình ảnh</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="thumbnail" class="form-label">Chọn hình thumbnail</label>
                                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror"
                                            id="thumbnail" name="thumbnail">
                                        @error('thumbnail')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <img id="thumbnail-img" class="w-100"
                                        src="{{ asset('storage/images/categories/' . $categorie->thumbnail) }}"
                                        onerror="this.src='{{ asset('assets/img/imageerror.jpg') }}'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </form>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection