@extends('_admin._layouts.app')

@push('style')
    <style>
        /* chỉnh chiều cao tối thiểu của khung soạn thảo */
        .ck-editor__editable_inline {
            min-height: 300px;
            /* bạn muốn 400px hay 500px cũng được */
        }
    </style>
@endpush
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
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.ckeditor.upload') . '?_token=' . csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
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
                <form action="{{ route('admin.articles.store') }}" method="post" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">Thông tin chung</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Đường dẫn bài viết (được tạo tự động khi nhập
                                            tiêu đề)</label>
                                        <input type="text" id="slug"
                                            class="form-control @error('slug') is-invalid @enderror" name="slug"
                                            value="{{ old('slug') }}" readonly>
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
                                        <label for="tilte" class="form-label">Tiêu đề bài viết</label>
                                        <input type="text" id="tilte"
                                            class="form-control @error('title') is-invalid @enderror" name="title"
                                            value="{{ old('title') }}">
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="tag" class="form-label">Tag</label>
                                        <input type="text" id="tag" class="form-control @error('tag') is-invalid @enderror"
                                            name="tag" value="{{ old('tag') }}">
                                        @error('tag')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả (một phần bài viết hoặc mô tả bài
                                            viết)</label>
                                        <textarea name="" id="description"
                                            class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Nội dung chính</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="content" class="form label">Nội dung chính</label>
                                        <textarea id="content" name="content">{!! old('content') !!}</textarea>
                                    </div>
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
                                <div class="card-header">Các danh mục</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="artist_id" class="form-label">Nghệ sĩ</label>
                                        <select name="artist_id" id="artist_id"
                                            class="form-select @error('artist_id') is-invalid @enderror">
                                            <option value="">Chọn nghệ sĩ</option>
                                            @foreach ($artists as $artist)
                                                <option value="{{ $artist->id }}">{{ $artist->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('artist_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="categories"
                                            class="form-label @error('categories') is-invalid @enderror">Danh mục</label>
                                        <select name="categories" id="categories" class="form-select">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
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
                                    <img id="thumbnail-img" class="w-100" src=""
                                        onerror="this.src='{{ asset('assets/img/imageerror.jpg') }}'">
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